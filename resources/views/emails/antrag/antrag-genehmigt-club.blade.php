@extends('emails.layouts.main')

@section('title', 'Wir heißen unser neues Mitglied herzlich willkommen.')

@section('content')
    <?php
        $antrags = DB::table('teams')->get();
    ?>
    <p>Soeben wurde der Mitgliedsantrag von {{ $antrag->vorname.' '.$antrag->nachname }} genehmigt.</p>

    <p>Ich der Webmaster und Clubmitgründer Alex begrüße unser neues Mitglied {{ $antrag->title }}</p>

    <p>Viel Spaß bei uns wünsche ich dir.</p>

    <p>Liebe Grüße Alex</p>

    <p>Zum Teammitglied: <a href="{{ url('team', $antrag->slug) }}">hier klicken</a> </p>


    @if ($antrag->fahrzeugvorhanden == false)
        <p>Zum Fahrzeug: <a href="{{ url('fahrzeuge', $antrag->fahrzeuge->slug) }}">hier klicken</a> </p>
    @endif

    <hr>

    <p style="font-weight: bold; font-size: 22px;">---- A N H A N G ----</p>

    <p>Ihr habt bei uns eine eigene E-Mail-Adresse, welche auf eure bei der Anmeldung registrierte E-Mail-Adresse weitergeleitet wird.</p>

    <p>Daher bitten wir euch darum unsere Domain (<i>"thueringer-tuning-freunde.de"</i>) in eurem E-Mail-Postfach freizugeben. Damit ihr alle Informationen per E-Mail von uns erhaltet.</p>

    <table width="100%" border="0">
        <tbody>
        <tr>
            <td style="width: 25%;">Standard E-Mail-Adressen:</td>
            <td>
                <a href="mailto:info@thueringer-tuning-freunde.de" target="_blank">Allgemeine Mail für Anfragen diese wird an Heiko & Alex weitergeleitet info@thueringer-tuning-freunde.de</a><br><br>
                <a href="mailto:webmaster@thueringer-tuning-freunde.de" target="_blank">E-Mails werden an Alex weitergeleitet webmaster@thueringer-tuning-freunde.de</a><br>
            </td>
        </tr>
        @if(count($antrags) > 0)
            @foreach($antrags as $item)
                {{--@if($item->published == true)
                    <tr style="margin: 10px 0;">
                        <td style="width: 25%; font-weight: bold;">{{ $item->title }}</td>
                        <td>
                            <a href="mailto:{{ $item->emailIntern }}@thueringer-tuning-freunde.de" target="_blank">{{ $item->emailIntern }}@thueringer-tuning-freunde.de</a>
                        </td>
                    </tr>
                @endif--}}
            @endforeach
        @endif
        </tbody>
    </table>

    <p>Solltet ihr uns allen eine E-Mail schreiben wollen so kannst du das an die E-Mail-Adresse <a href="mailto:club@thueringer-tuning-freunde.de" target="_blank">club@thueringer-tuning-freunde.de</a>?
        Hier kannst du gerne Informationen hinschicken z.b.: für Treffen oder sonstiges was für dich Relevant scheint und du uns das gerne mitteilen möchtest.</p>
@endsection
