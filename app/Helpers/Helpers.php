<?php

namespace App\Helpers;

use Carbon\Carbon;
use DateTime;
use File;
use Intervention\Image\Facades\Image;

class Helpers
{
    public static function getDatesFromRange($date_time_from, $date_time_to)
    {
        $start = Carbon::createFromFormat('Y-m-d H:i', substr($date_time_from, 0, 16));
        $end = Carbon::createFromFormat('Y-m-d H:i', substr($date_time_to, 0, 16));

        $dates = [];

        while ($start->lte($end)) {
            $dates[] = $start->copy()->format('Y-m-d H:i');
            $start->addDay();
        }

        return $dates;
    }

    public static function teamInitials($query)
    {
        $initials = [];
        foreach ($query as $item) {
            $name = $item->vorname . ' ' . $item->nachname;
            $name_array = explode(' ', trim($name));

            $firstWord = $name_array[0];
            $lastWord = $name_array[count($name_array)-1];
            $initials[$item->id] = mb_substr($firstWord[0],0,1).''.mb_substr($lastWord[0],0,1);
        }

        return $initials;
    }

    public static function teamInitial($query)
    {
        $initial = '';
        $name = $query->vorname . ' ' . $query->nachname;
        $name_array = explode(' ', trim($name));

        $firstWord = $name_array[0];
        $lastWord = $name_array[count($name_array)-1];
        return mb_substr($firstWord[0],0,1) .mb_substr($lastWord[0],0,1);
    }

    public static function getDaysRate($date_from, $date_to)
    {
        $start = Carbon::createFromFormat('Y-m-d H:i:s', $date_from);
        $end = Carbon::createFromFormat('Y-m-d H:i:s', $date_to);

        return $start->diffInDays($end);
    }

    public static function getHourRate($date_from, $date_to)
    {
        $start = Carbon::createFromFormat('Y-m-d H:i:s', $date_from);
        $end = Carbon::createFromFormat('Y-m-d H:i:s', $date_to);

        return number_format($start->floatDiffInHours($end), 2, ',', '.');
    }

    public static function bytesToHuman($bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

        $step = 1024;
        $i = 0;
        while (($bytes / $step) > 0.9) {
            $bytes /= $step;
            $i++;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public static function dateOfBirth($datum, $text = '%Y Jahre'): string
    {
        date_default_timezone_set("Europe/Berlin");
        $datum1 = new DateTime($datum);
        $datum2 = new DateTime(date('d').'-'.date('m').'-'.date('Y'));
        return ($datum2->diff($datum1)->format($text));
    }

    public static function updateImage($request, $team, $file = 'profilbild'): array|string
    {
        $search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "´", " ", "_");
        $replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "", "-", "-");

        if (!$request->hasFile($file)) {
            $image = $team->image;
            if (!File::isDirectory(public_path($image))) {
                File::makeDirectory(public_path($image), 0777, true, true);
            }
        } else {
            $images = $request->file($file);
            if (isset($images)) {
                $imagess = time().'-'.strtolower($request->vorname) . ' ' . strtolower($request->nachname) . '/' . $images->getClientOriginalName();
                $image = str_replace($search, $replace, $imagess);

                if (File::exists(public_path($team->image))) {
                    File::delete(public_path($team->image));
                }

                if (!File::isDirectory(public_path('images/profil/' . str_replace($search, $replace, strtolower($request->vorname) . ' ' . strtolower($request->nachname))))) {
                    File::makeDirectory(public_path('images/profil/' . str_replace($search, $replace, strtolower($request->vorname) . ' ' . strtolower($request->nachname))), 0777, true, true);
                }

                $profilImage = Image::make($images)->resize(1280, 720, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->stream();
                File::put(public_path('images/profil/'.$image), $profilImage);
            }
        }

        return $image;
    }

    public static function imageUploadWithThumbnailMultiple($request, $hasFile, $path)
    {
        $image = [];
        $images = $request->hasFile($hasFile);
        if (!empty($images)) {
            foreach ($request->file('images') as $images) {
                $imageName = time().'-'.$images->getClientOriginalName();
                $nameToString = self::replaceBlank($imageName);

                if (!File::isDirectory(public_path($path))) {
                    File::makeDirectory(public_path($path), 0777, true, true);
                }

                if (!File::isDirectory(public_path($path . '/thumbnails'))) {
                    File::makeDirectory(public_path($path . '/thumbnails'), 0777, true, true);
                }

                // Thumbnails
                $watermark = public_path('images/watermark.png');
                $thumbnails = Image::make($images)->resize(624, 612, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->insert($watermark, 'bottom-right', 10, 10)->stream();
                File::put(public_path($path. '/thumbnails/' .$nameToString), $thumbnails);

                // Images Original
                $photo = Image::make($images)->insert($watermark, 'bottom-right', 10, 10)->stream();
                File::put(public_path($path . '/' . $nameToString), $photo);

                $data[] = $nameToString;
                $dataThumbnail[] = 'thumbnails/' . $nameToString;
                $size[] = self::bytesToHuman($images->getSize());
            }
        } else {
            if (!File::isDirectory(public_path($path))) {
                File::makeDirectory(public_path($path), 0777, true, true);
            }
            $data = null;
            $dataThumbnail = null;
            $size = null;
        }

        return [
            'data' => $data,
            'dataThumbnail' => $dataThumbnail,
            'size' => $size
        ];
    }
    public static function imageUpload($request, $file, $path)
    {
        $images = $request->file($file);
        if (isset($images)) {
            $imageName = time().'-'.$images->getClientOriginalName();
            $nameToString = self::replaceBlank($imageName);

            if (File::exists(public_path($path))) {
                File::delete(public_path($path));
            }

            if (!File::isDirectory(public_path($path))) {
                File::makeDirectory(public_path($path), 0777, true, true);
            }

            // Images Original
            $photo = Image::make($images)->resize(624, 612, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->stream();
            File::put(public_path($path . '/' .$nameToString), $photo);
            return $nameToString;
        }
        return null;
    }

    public static function allFileSize($path)
    {
        $fileSize = 0;
        foreach (File::allFiles(public_path($path)) as $file) {
            $fileSize += $file->getSize();
        }

        return self::bytesToHuman($fileSize);
    }

    public static function replaceStrToLower($item): string
    {
        $search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "´", " ", "_");
        $replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "", "-", "-");

        return strtolower(str_replace($search, $replace, $item));
    }

    public static function replaceStrToUpper($item): string
    {
        $search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "´", " ", "_");
        $replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "", "-", "-");

        return strtoupper(str_replace($search, $replace, $item));
    }

    public static function replaceBlank($item): string
    {
        $search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "´", " ", "_");
        $replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "", "-", "-");

        return str_replace($search, $replace, $item);
    }

    public static function replaceBlankMinus($item): string
    {
        $search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "´", " ", "-", "_");
        $replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "", "-", " ", "-");

        return str_replace($search, $replace, $item);
    }

    public static function passwort_generate($chars)
    {
        $data = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_';
        return substr(str_shuffle($data), 0, $chars);
    }
}
