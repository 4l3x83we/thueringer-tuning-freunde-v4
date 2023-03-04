<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Geburtstagsliste</title>
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">--}}
    <style>
        @media dompdf {
            * {
                line-height: 1.3;
            }
        }
        @page {
            margin: 0cm 0cm;
        }
        html {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: "Open Sans", sans-serif;
            width: 21cm;
            margin: 0 auto;
            padding: 1cm 0;
        }
        h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
            font-family: "Arial", sans-serif;
            margin: 0;
        }
        table {
            width: 100%;
        }
        #Satzung, #Gruendungsmitglied, #Clubmitglied, #Werkstattordnung, #Werkstattnutzung, #Admin {
            padding: 0 1cm;
        }
        .text-center {
            text-align: center;
        }
        .margin-12 {
            margin: 12px 0;
        }
        .border-table {
            border-bottom: 1px solid;
            padding-left: 10px;
        }
        .border-table:last-child {
            border-bottom: none;
        }
        .striped {
            border-collapse: collapse;
        }
        .striped tr:nth-child(even) {
            background-color: #cccccc;
        }
        .striped tr:nth-child(odd) {
            background-color: transparent;
        }
        #Werkstattnutzung td {
            padding: 0;
        }
    </style>
</head>
<body>
    <table id="Satzung">
        <tbody>
        <tr>
            <td>
                <h1 class="text-center" style="margin: 16px;">Satzung</h1>
            </td>
        </tr>
        <tr>
            <td>
                <h3 class="text-center" style="margin: 0 0 16px;">Satzung des nicht eingetragenen Clubs „Thüringer Tuning Freunde“</h3>
            </td>
        </tr>
        <!-- $1 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 1 Name und Sitz des Clubs</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Der Club führt den Namen „Thüringer Tuning Freunde“</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">2.</td>
                        <td>Der Club ist ein „nicht eingetragener Verein“</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">3.</td>
                        <td>Der Club hat seinen Sitz unter folgender Adresse:<br>
                            {{ env('TTF_STRASSE') }}<br>
                            {{ env('TTF_ORT') }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $2 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 2 Zweck des Clubs</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Bekämpfung des Markenhasses untereinander und die aufrecht Erhaltung älterer Fahrzeuge</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">2.</td>
                        <td>Spaß am Hobby Auto (Tuning, Instandsetzen älterer Fahrzeuge, Schrauben allgemein)</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $3 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 3 Der Club erfüllt seine Aufgaben durch</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Regelmäßige Fahrten zu Tuning Treffen</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">2.</td>
                        <td>Mindestens 2 gemeinsame jährliche Treffen</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">3.</td>
                        <td>Wechselnde Ausfahrten über das Jahr vereitelt</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $4 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 4 Eintragung in das Vereinsregister</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Der Club ist nicht im Vereinsregister eingetragen</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">2.</td>
                        <td>Die erwirtschafteten Einnahmen aus Reparaturen oder der Nutzung der Werkstatt dienen der monatlichen Miete für das Clubhaus und kommen, sofern noch was übrigbleibt, dem Club zugute</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $5 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 5 Eintritt der Mitglieder</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Der Bedarf wird durch die Gründungsmitglieder bestimmt</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">2.</td>
                        <td>Für eine dauerhafte Mitgliedschaft muss sich der/die Interessent/Interessentin schriftlich über unsere Homepage, telefonisch oder vor Ort an die Gründungsmitglieder wenden</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">3.</td>
                        <td>Eine Aufnahmegebühr wird nicht erhoben</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">4.</td>
                        <td>Die Mitgliedschaft ist wirksam mit der Bestätigungs-E-Mail  (Willkommens-E-Mail durch den Webmaster)</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $6 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 6 Austritt der Mitglieder</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Dauerhafte Mitgliedschaften können schriftlich oder mündlich den Gründungsmitgliedern angezeigt werden. Die formale Mitgliedschaft endet zum jeweiligen Ende eines Quartals (31.03, 30.06, 30.09 oder 31.12)</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $7 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 7 Mitgliedsbeiträge</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Es wird ein Mitgliedsbeitrag von 20 € pro Monat erhoben. Dieser ist fällig zum 5. des jeweiligen Monats.</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">2.</td>
                        <td>Für Mitglieder die § 7.1 nutzen ist eine Gebühr für die Hebebühne in Höhe von 5 € pro Stunde fällig</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">3.</td>
                        <td>Eine Beteiligung an der Werkstatt ist möglich, dies ist in 3 Staffeln unterteilt:<br>
                            25 € monatlich freie Nutzung im Monat von 10 Stunden der Werkstatt vorher anzumelden<br>
                            50 € monatlich freie Nutzung im Monat von 25 Stunden der Werkstatt vorher anzumelden<br>
                            100 € monatlich freie Nutzung im Monat (für Fahrzeuge naher Familienangehöriger sind für euch maximal 20 Stunden freie Nutzung vorgesehen)
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">4.</td>
                        <td>Die Mitgliedsbeiträge werden zur Miete und Aufwandsentschädigung genutzt. Der Mitgliedsbeitrag kann jährlich durch die Gründungsmitglieder neu bestimmt werden (Grillen an den zweimal im Jahr stattfindenden Versammlungen)</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">5.</td>
                        <td>Die restlichen Beiträge sind fällig zum 1. Bankarbeitstag des jeweiligen Monats.</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $8 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 8 Organe des Clubs</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Gründungsmitglieder</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">2.</td>
                        <td>Clubmitglieder</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $9 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 9 Gründungsmitglieder</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td colspan="2">Die Gründungsmitglieder des Clubs „Thüringer Tuning Freunde“ besteht aus</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Den Gründungsmitgliedern (siehe Anlage Gründungsmitglieder)</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">2.</td>
                        <td>Den Clubmitgliedern (siehe Anlage Clubmitglieder)</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $10 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 10 Mitgliederversammlung</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Die Mitgliederversammlung erfolgt einmal im Monat und wird min. 4 Wochen vorher angekündigt</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $11 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 11 Beschlussfähigkeit des Clubs</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Gründungsmitglieder entscheiden über die alltäglichen Dinge des Clubs</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $12 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 12 Beschlussfassung</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Es wird per Handzeichen abgestimmt</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">2.</td>
                        <td>Eines der Clubmitglieder wird vorab zum Protokollführer ernannt</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">3.</td>
                        <td>Änderungen des Zweckes des Clubs obliegen ausschließlich den Gründungsmitgliedern</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $13 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 13 Beurkundung der Versammlungsbeschlüsse</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td colspan="2">Über die in den Versammlungen gefassten Beschlüsse ist eine Niederschrift anzulegen und zu archivieren</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $14 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 14 Auflösung des Clubs</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Der Club „Thüringer Tuning Freunde“ kann ausschließlich durch die Gründungsmitglieder aufgelöst werden.</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $15 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 15 Haftung des Clubs</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Die Haftung in jeglichen Fragen wird auf die Gründungsmitglieder beschränkt. Eine Haftung der Clubmitglieder besteht nicht. (Nur bei grob fahrlässigen Verletzungen.)</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">2.</td>
                        <td>Die Haftung ist auf das Clubvermögen (aus Mitgliedsbeiträgen) beschränkt.</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>

    <div style="page-break-after: always;"></div>
    <table id="Gruendungsmitglied">
        <tbody>
        <tr>
            <td>- Anlage: Gründungsmitglieder -</td>
        </tr>
        <tr>
            <td>
                <h3 class="text-center" style="margin: 32px 0 16px;">Gründungsmitglieder in der Übersicht</h3>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tbody>
                        @if($teams[1]->funktion === 'Gründungsmitglied & Chef' or $teams[0]->funktion === 'Gründungsmitglied & Webmaster')
                            <tr>
                                <td colspan="2" style="width: 50%; font-weight: bold; padding-bottom: 10px; padding-left: 10px;">1. Gründungsmitglied</td>
                                <td colspan="2" style="width: 50%; font-weight: bold; padding-bottom: 10px; padding-left: 10px;">2. Gründungsmitglied</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="width: 50%; padding-left: 10px;">{{ $teams[1]->vorname . ' ' . $teams[1]->nachname }}</td>
                                <td colspan="2" style="width: 50%; padding-left: 10px;">{{ $teams[0]->vorname . ' ' . $teams[0]->nachname }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="width: 50%; padding-left: 10px;">{{ $teams[1]->straße }}</td>
                                <td colspan="2" style="width: 50%; padding-left: 10px;">{{ $teams[0]->straße }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="width: 50%; padding-left: 10px;">{{ $teams[1]->plz . ' ' . $teams[1]->wohnort }}</td>
                                <td colspan="2" style="width: 50%; padding-left: 10px;">{{ $teams[0]->plz . ' ' . $teams[0]->wohnort }}</td>
                            </tr>
                            <tr>
                                <td style="width: 10%; padding-top: 10px; padding-left: 10px;">Telefon:</td>
                                <td style="width: 40%; padding-top: 10px;">@if($teams[1]->telefon) {{ $teams[1]->telefon }} @else {{ $teams[1]->mobil }} @endif</td>
                                <td style="width: 10%; padding-top: 10px; padding-left: 10px;">Telefon:</td>
                                <td style="width: 40%; padding-top: 10px;">@if($teams[1]->telefon) {{ $teams[0]->telefon }} @else {{ $teams[0]->mobil }} @endif</td>
                            </tr>
                            @if($teams[1]->telefon)
                                <tr>
                                    <td style="width: 10%; padding-left: 10px;"></td>
                                    <td style="width: 40%;">{{ $teams[1]->mobil }}</td>
                                    <td style="width: 10%; padding-left: 10px;"></td>
                                    <td style="width: 40%;">{{ $teams[0]->mobil }}</td>
                                </tr>
                            @endif
                        @endif
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>

    <div style="page-break-after: always;"></div>
    <table id="Clubmitglied">
        <tbody>
        <tr>
            <td>- Anlage: Clubmitglieder -</td>
        </tr>
        <tr>
            <td>
                <h3 class="text-center" style="margin: 32px 0 16px;">Clubmitglieder in der Übersicht</h3>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tbody>
                    <tr>
                        <td style="vertical-align: top;">
                        @for($i = 2; $i <= $teamCount - 1; $i+=2)
                            <div class="border-table">
                                <div style="padding-top: 10px;"></div>
                                <div>{{ $teams[$i]->vorname . ' ' . $teams[$i]->nachname }}</div>
                                <div>{{ $teams[$i]->straße }}</div>
                                <div>{{ $teams[$i]->plz . ' ' . $teams[$i]->wohnort }}</div>
                                <div style="padding-top: 10px;">Telefon: @if($teams[$i]->telefon) {{ $teams[$i]->telefon }} @else {{ $teams[$i]->mobil }} @endif</div>
                                @if($teams[$i]->telefon)
                                    <div> {{ $teams[$i]->mobil }}</div>
                                @endif
                                <div style="padding-bottom: 10px;"></div>
                            </div>
                        @endfor
                        </td>
                        <td style="vertical-align: top;">
                        @for($i = 3; $i <= $teamCount - 1; $i+=2)
                            <div class="border-table">
                                <div style="padding-top: 10px;"></div>
                                <div>{{ $teams[$i]->vorname . ' ' . $teams[$i]->nachname }}</div>
                                <div>{{ $teams[$i]->straße }}</div>
                                <div>{{ $teams[$i]->plz . ' ' . $teams[$i]->wohnort }}</div>
                                <div style="padding-top: 10px;">Telefon: @if($teams[$i]->telefon) {{ $teams[$i]->telefon }} @else {{ $teams[$i]->mobil }} @endif</div>
                                @if($teams[$i]->telefon)
                                    <div> {{ $teams[$i]->mobil }}</div>
                                @endif
                                <div style="padding-bottom: 10px;"></div>
                            </div>
                        @endfor
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>

    <div style="page-break-after: always;"></div>
    <table id="Werkstattordnung">
        <tbody>
        <tr>
            <td>- Anlage: Werkstattnutzung -</td>
        </tr>
        <tr>
            <td>
                <h3 class="text-center" style="margin: 32px 0 16px;">Werkstattnutzung und Werkstattordnung</h3>
            </td>
        </tr>
        <!-- $1 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 1 Nutzung der Werkstatt </h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Die Werkstatt kann von jedem Teammitglied genutzt werden zu den vorgegebenen Zeiten darüber hinaus in Absprache mit Heiko.</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">2.</td>
                        <td>Die Nutzung der Werkstatt ist mit Heiko oder Roland abzusprechen sodass ihr Zugang erlangt. (Kalender nutzen auf Webseite sonst kein Zugang)</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $2 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 2 Ordnung in der Werkstatt</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Die Werkstatt ist aufgeräumt zu hinterlassen, jedes Werkzeug kommt wieder an seinen Platz, es sei den es geht, am nächsten Tag weiter, aber sobald dein Auto fertig ist, kommt das Werkzeug an seinen Platz.</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">2.</td>
                        <td>Bei zu viel Dreck auf dem Boden (z. B.: durch Rost, Öl usw.) sind diese zu entfernen durch dich. (Ölbindemittel ist vorhanden)</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">3.</td>
                        <td>Altteile sind zu entsorgen, dafür steht euch eine Box zur Verfügung, dazu mehr unter Paragraf 4.</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $3 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 3 Grundstück</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Die Parksituation ist so zu wählen, dass vorzugsweise auf dem Grundstück geparkt wird, die ersten 2 Parkplätze rechts neben dem Tor sind für Heiko und Roland freizuhalten, egal was ist.</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">2.</td>
                        <td>Sollte das Grundstück voll sein mit Fahrzeugen, so bitten wir euch ordnungsgemäß neben dem Unterstand zu parken am Haupteingang.</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">3.</td>
                        <td>Der Lärm durch Motorengeräusche ist auf ein Minimum zu reduzieren, zum Wohle der Nachbarschaft und der Tiere.</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">4.</td>
                        <td>Das Grundstück ist in einem sauberen und ordentlichen Zustand zu verlassen.</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $4 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 4 Entsorgung</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Betriebsflüssigkeiten (Öl, Brems- & Kühlflüssigkeiten) werden durch uns getrennt entsorgt und gesondert <u style="font-weight: bold;">berechnet, da wir an einem Umweltsystem angeschlossen sind und dies ist auch für uns als Club nicht kostenlos.</u></td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">2.</td>
                        <td>Papier, Pappe, Folien usw. müssen wieder mitgenommen werden.</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $5 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 5 Verpflegung</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Wir sind ein kleiner Club, dieser ist auf jedes Mitglied angewiesen. Daher bitten wir euch, solltet ihr Kaffee, Cappuccino, alkoholische Getränke oder nicht alkoholische Getränke verzehren, die bereitgestellt werden, so bitten wir euch darum, das ein oder andere wieder mitzubringen oder einen Obolus zu hinterlassen.</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">2.</td>
                        <td>Grillen oder Mittagessen ist möglich, sofern ihr euch was mitbringt und ihr danach den Küchenbereich wieder sauber verlasst.</td>
                    </tr>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">3.</td>
                        <td>Grillzubehör (Grillkohle, Anzünder) solltet ihr mitbringen.</td>
                    </tr>
                    {{--<tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">4.</td>
                        <td>Die Punkte 1 – 3 gelten außerhalb unserer zweimal im Jahr stattfindenden Versammlung, denn dafür werden die Mitgliedsbeiträge genutzt.</td>
                    </tr>--}}
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- $6 -->
        <tr>
            <td>
                <h4 class="text-center margin-12">§ 6 Strafe</h4>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-size: 14px;">
                    <tbody>
                    <tr>
                        <td style="width: 25px; text-align: right; padding-right: 5px; vertical-align: top;">1.</td>
                        <td>Bei Widersetzen, das Paragrafen 2 und 3 wird mit einem Bußgeld von 10,00 € geahndet, welches dem allgemein wohl des Clubs zugutekommt.</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>

    <div style="page-break-after: always;"></div>
    <table id="Werkstattnutzung" style="font-size: 14px;">
        <tbody>
        <tr>
            <td>
                <p style="font-weight: bold;">Zeiten für die Nutzung der Werkstatt:</p>
                <p>Montag bis Freitag in Absprache mit Heiko</p>
                <p>Bitte nutzt den Kalender, da werden die richtigen Personen kontaktiert und bestätigen deinen Termin oder ändern ihn in Absprache mit dir.</p>
                <p>Samstag steht euch die Werkstatt von 09:30 - 13:30 Uhr garantiert zur Verfügung, vorher bitte im Kalender schauen, ob die Hebebühne belegt ist.</p>
                <p>Samstag könnt ihr gerne einfach so vorbeikommen, ohne dass ihr was machen müsst. In dem oben genannten Zeitraum sind auf jeden Fall immer Heiko, Roland und Alex vor Ort.</p>
                <p><em><u>Sonntags ist die Nutzung der Werkstatt nur im äußersten Notfall zu nutzen.</u></em> Und <u>NUR</u> in Absprache mit Heiko möglich.</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Kernzeiten der Werkstattnutzung für <b>Teammitglieder</b></p>
            </td>
        </tr>
        <tr>
            <td>
                <table class="striped">
                    <tbody>
                    <tr>
                        <td style="text-align: right; padding: 5px; border-bottom: 1px solid; width: 15%;">Tag</td>
                        <td style="text-align: left; padding: 5px; border-bottom: 1px solid;">Uhrzeit</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; padding: 5px; width: 15%;"><em>Montag</em></td>
                        <td style="text-align: left; padding: 5px; border-left: 1px solid;">auf Anfrage</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; padding: 5px; width: 15%;"><em>Dienstag</em></td>
                        <td style="text-align: left; padding: 5px; border-left: 1px solid;">auf Anfrage</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; padding: 5px; width: 15%;"><em>Mittwoch</em></td>
                        <td style="text-align: left; padding: 5px; border-left: 1px solid;">auf Anfrage</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; padding: 5px; width: 15%;"><em>Donnerstag</em></td>
                        <td style="text-align: left; padding: 5px; border-left: 1px solid;">auf Anfrage</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; padding: 5px; width: 15%;"><em>Freitag</em></td>
                        <td style="text-align: left; padding: 5px; border-left: 1px solid;">auf Anfrage</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; padding: 5px; width: 15%;"><em>Samstag</em></td>
                        <td style="text-align: left; padding: 5px; border-left: 1px solid;">09:30 - 13:30 Uhr darüber hinaus auf Anfrage</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; padding: 5px; width: 15%;"><em>Sonntag</em></td>
                        <td style="text-align: left; padding: 5px; border-left: 1px solid;">nur im Notfall</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-top: 32px;">
                <table>
                    <tbody>
                    <tr>
                        <td colspan="2">Bankverbindung für Einzahlungen der Werkstatt</td>
                        <td colspan="2">Bankverbindung für Einzahlungen des Mitgliedsbeitrags</td>
                    </tr>
                    <tr>
                        <td>Kontoinhaber:</td>
                        <td>Heiko Eisenschmidt</td>
                        <td>Kontoinhaber:</td>
                        <td>Heiko Eisenschmidt</td>
                    </tr>
                    <tr>
                        <td>IBAN:</td>
                        <td>DE34700170007241655474</td>
                        <td>IBAN:</td>
                        <td>DE34700170007241655474</td>
                    </tr>
                    <tr>
                        <td>BIC:</td>
                        <td>PAGMDEM1XXX</td>
                        <td>BIC:</td>
                        <td>PAGMDEM1XXX</td>
                    </tr>
                    <tr>
                        <td>Bank:</td>
                        <td>PayCenter</td>
                        <td>Bank:</td>
                        <td>PayCenter</td>
                    </tr>
                    <tr>
                        <td>Verwendungszweck:</td>
                        <td>{{ $team->vorname . ' ' . $team->nachname[0] . '. für Werkstatt' }}</td>
                        <td>Verwendungszweck:</td>
                        <td>{{ 'Mitgliedsbeitrag ' . $team->vorname . ' ' . $team->nachname[0] . '.' }}</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    @hasanyrole('super_admin|admin')
    <div style="page-break-after: always;"></div>
    <table id="Admin" style="font-size: 14px;" class="striped">
        <tbody>
        <tr>
            <td colspan="3">
                <p>Zur Kenntnis genommen:</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 5px; border-bottom: 1px solid; font-weight: bold;">Name</td>
            <td style="padding: 5px; border-bottom: 1px solid; font-weight: bold;">Datum</td>
            <td style="padding: 5px; border-bottom: 1px solid; font-weight: bold;">Unterschrift</td>
        </tr>
        @for($i = 0; $i <= $teamCount - 1; $i++)
            <tr>
                <td style="padding: 5px; border-bottom: 1px solid;">{{ $teams[$i]->vorname . ' ' . $teams[$i]->nachname[0] . '.' }}</td>
                <td style="padding: 5px; border-bottom: 1px solid; border-left: 1px solid;"></td>
                <td style="padding: 5px; border-bottom: 1px solid; border-left: 1px solid;"></td>
            </tr>
        @endfor
        @for($i = 1; $i <= 30 - $teamCount; $i++)
        <tr>
            <td style="padding: 5px; border-bottom: 1px solid;">&nbsp;</td>
            <td style="padding: 5px; border-bottom: 1px solid; border-left: 1px solid;">&nbsp;</td>
            <td style="padding: 5px; border-bottom: 1px solid; border-left: 1px solid;">&nbsp;</td>
        </tr>
        @endfor
        </tbody>
    </table>
    <div style="page-break-after: always;"></div>
    <table id="Admin" style="font-size: 14px;" class="striped">
        <tbody>
        <tr>
            <td colspan="2">
                <p>Mitgliedsbeiträge / Miete</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 5px; border-bottom: 1px solid; font-weight: bold;">Name:</td>
            <td style="padding: 5px; border-bottom: 1px solid; font-weight: bold;">Betrag:</td>
        </tr>
        <tr>
            <td colspan="2" style="padding: 5px; border-bottom: 1px solid; font-weight: bold; text-align: center">Werkstattbeteiligung</td>
        </tr>
        @foreach($teams as $team)
            @if($team->zahlungsArt === 'wb')
            <tr>
                <td style="padding: 5px; border-bottom: 1px solid;">{{ $team->vorname . ' ' . $team->nachname[0] . '.' }}</td>
                <td style="padding: 5px; border-bottom: 1px solid; border-left: 1px solid;">{{ number_format($team->zahlung, 2, ',', '.') . ' €' }}</td>
            </tr>
            @endif
        @endforeach
        <tr>
            <td style="font-weight: bold; text-align: right; padding: 5px; border-bottom: 1px solid;">Werkstattbeteiligung monatlich:</td>
            <td style="font-weight: bold; padding: 5px; border-bottom: 1px solid; border-left: 1px solid;">{{ number_format($teams->wb, 2, ',', '.') . ' €' }}</td>
        </tr>
        <tr>
            <td colspan="2" style="padding: 5px; border-bottom: 1px solid; font-weight: bold; text-align: center">Mitgliedsbeiträge</td>
        </tr>
        @foreach($teams as $team)
            @if($team->zahlungsArt === 'mb')
                <tr>
                    <td style="padding: 5px; border-bottom: 1px solid;">{{ $team->vorname . ' ' . $team->nachname[0] . '.' }}</td>
                    <td style="padding: 5px; border-bottom: 1px solid; border-left: 1px solid;">{{ number_format($team->zahlung, 2, ',', '.') . ' €' }}</td>
                </tr>
            @endif
        @endforeach
        <tr>
            <td style="font-weight: bold; text-align: right; padding: 5px; border-bottom: 1px solid;">Mitgliedsbeiträge monatlich:</td>
            <td style="font-weight: bold; padding: 5px; border-bottom: 1px solid; border-left: 1px solid;">{{ number_format($teams->mb, 2, ',', '.') . ' €' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold; text-align: right; padding: 5px; border-bottom: 1px solid;">Gesamtsumme monatlich:</td>
            <td style="font-weight: bold; padding: 5px; border-bottom: 1px solid; border-left: 1px solid;">{{ number_format($teams->gesamt, 2, ',', '.') . ' €' }}</td>
        </tr>
        </tbody>
    </table>
    @endhasanyrole
</body>
</html>
