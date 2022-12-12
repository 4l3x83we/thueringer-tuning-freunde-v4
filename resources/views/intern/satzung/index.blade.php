@extends('layouts.app')

@section('title', 'Satzung')
@section('description'){{ strip_tags(Str::limit('Satzung des nicht eingetragenen Clubs „Thüringer Tuning Freunde“'), 150) }}@endsection
@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <section class="satzung" id="satzung">
        <div class="container">

            <div class="section-title">
                <h2>@yield('title')</h2>
                <p>@yield('description')</p>
            </div>

            <div class="row">
                <div class="col-12 text-bg-dark shadow satzungTable border-radius-10">
                    <div class="row">
                        <div class="col-lg-12 d-flex justify-content-end my-3">
                            <a href="{{ route('intern.pdf.satzung', ['download' => 'pdf']) }}" class="btn btn-link print-btn p-0 text-decoration-none d-print-none" style="font-size: 18px;">Satzung als PDF <em class="bi bi-file-pdf"></em></a>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="container">
                                <!-- $1 -->
                                <h5 class="text-center pb-2">§ 1 Name und Sitz des Clubs</h5>
                                <ol>
                                    <li>Der Club führt den Namen „Thüringer Tuning Freunde“</li>
                                    <li>Der Club ist ein „nicht eingetragener Verein“</li>
                                    <li>Der Club hat seinen Sitz unter folgender Adresse:<br>
                                        Rosenstraße 2a<br>
                                        06571 Roßleben</li>
                                </ol>

                                <!-- $2 -->
                                <h5 class="text-center pb-2">§ 2 Zweck des Clubs</h5>
                                <ol>
                                    <li>Bekämpfung des Markenhasses untereinander und die aufrecht Erhaltung älterer Fahrzeuge</li>
                                    <li>Spaß am Hobby Auto (Tuning, Instandsetzen älterer Fahrzeuge, Schrauben allgemein)</li>
                                </ol>

                                <!-- $3 -->
                                <h5 class="text-center pb-2">§ 3 Der Clubs erfüllt seine Aufgaben durch</h5>
                                <ol>
                                    <li>Regelmäßige Fahrten zu Tuning Treffen</li>
                                    <li>Mindestens 2 gemeinsame jährliche Treffen</li>
                                    <li>Wechselnde Ausfahrten über das Jahr vereitelt</li>
                                </ol>

                                <!-- $4 -->
                                <h5 class="text-center pb-2">§ 4 Eintragung in das Vereinsregister</h5>
                                <ol>
                                    <li>Der Club ist nicht im Vereinsregister eingetragen</li>
                                    <li>Die erwirtschafteten Einnahmen aus Reparaturen oder der Nutzung der Werkstatt dienen der monatlichen
                                        Miete für das Clubhaus und kommen, sofern noch was übrigbleibt, dem Club zugute
                                    </li>
                                </ol>

                                <!-- $5 -->
                                <h5 class="text-center pb-2">§ 5 Eintritt der Mitglieder</h5>
                                <ol>
                                    <li>Der Bedarf wird durch die Gründungsmitglieder bestimmt</li>
                                    <li>Für eine dauerhafte Mitgliedschaft muss sich der/die Interessent/Interessentin schriftlich über unsere
                                        Homepage, telefonisch oder vor Ort an die Gründungsmitglieder wenden
                                    </li>
                                    <li>Eine Aufnahmegebühr wird nicht erhoben</li>
                                    <li>Die Mitgliedschaft ist wirksam mit der Bestätigungs-E-Mail (Willkommens-E-Mail durch den Webmaster)
                                    </li>
                                </ol>

                                <!-- $6 -->
                                <h5 class="text-center pb-2">§ 6 Austritt der Mitglieder</h5>
                                <ol>
                                    <li>Dauerhafte Mitgliedschaften können schriftlich oder mündlich den Gründungsmitgliedern angezeigt werden.
                                        Die formale Mitgliedschaft endet zum jeweiligen Ende eines Quartals (31.03, 30.06, 30.09 oder 31.12)</li>
                                </ol>

                                <!-- $7 -->
                                <h5 class="text-center pb-2">§ 7 Mitgliedsbeiträge</h5>
                                <ol>
                                    <li>Es wird ein Mitgliedsbeitrag von 20 € pro Monat erhoben. Dieser ist fällig zum 5. des jeweiligen Monats.</li>
                                    <li>Für Mitglieder die § 7.1 nutzen ist eine Gebühr für die Hebebühne in Höhe von 5 € pro Stunde fällig</li>
                                    <li>Eine Beteiligung an der Werkstatt ist möglich, dies ist in 3 Staffeln unterteilt:<br>
                                        25 € monatlich freie Nutzung im Monat von 10 Stunden der Werkstatt vorher anzumelden<br>
                                        50 € monatlich freie Nutzung im Monat von 25 Stunden der Werkstatt vorher anzumelden<br>
                                        100 € monatlich freie Nutzung im Monat (für Fahrzeuge naher Familienangehöriger sind für euch maximal 20 Stunden freie Nutzung vorgesehen)
                                    </li>
                                    <li>Die Mitgliedsbeiträge werden zur Miete und Aufwandsentschädigung genutzt. Der Mitgliedsbeitrag kann
                                        jährlich durch die Gründungsmitglieder neu bestimmt werden (Grillen an den zweimal im Jahr stattfindenden
                                        Versammlungen)
                                    </li>
                                    <li>Die restlichen Beiträge sind fällig zum 1. Bankarbeitstag des jeweiligen Monats.</li>
                                </ol>

                                <!-- $8 -->
                                <h5 class="text-center pb-2">§ 8 Organe des Clubs</h5>
                                <ol>
                                    <li>Gründungsmitglieder</li>
                                    <li>Clubmitglieder</li>
                                </ol>

                                <!-- $9 -->
                                <h5 class="text-center pb-2">§ 9 Gründungsmitglieder</h5>
                                <p>Die Gründungsmitglieder des Clubs „Thüringer Tuning Freunde“ besteht aus</p>
                                <ol>
                                    <li>Den Gründungsmitgliedern (siehe Anlage Gründungsmitglieder)</li>
                                    <li>Den Clubmitgliedern (siehe Anlage Clubmitglieder)</li>
                                </ol>

                                <!-- $10 -->
                                <h5 class="text-center pb-2">§ 10 Mitgliederversammlung</h5>
                                <ol>
                                    <li>Die Mitgliederversammlung erfolgt einmal im Monat und wird min. 4 Wochen vorher angekündigt</li>
                                </ol>

                                <!-- $11 -->
                                <h5 class="text-center pb-2">§ 11 Beschlussfähigkeit des Clubs</h5>
                                <ol>
                                    <li>Gründungsmitglieder entscheiden über die alltäglichen Dinge des Clubs</li>
                                </ol>

                                <!-- $12 -->
                                <h5 class="text-center pb-2">§ 12 Beschlussfassung</h5>
                                <ol>
                                    <li>Es wird per Handzeichen abgestimmt</li>
                                    <li>Eines der Clubmitglieder wird vorab zum Protokollführer ernannt</li>
                                    <li>Änderungen des Zweckes des Clubs obliegen ausschließlich den Gründungsmitgliedern</li>
                                </ol>

                                <!-- $13 -->
                                <h5 class="text-center pb-2">§ 13 Beurkundung der Versammlungsbeschlüsse</h5>
                                <p>Über die in den Versammlungen gefassten Beschlüsse ist eine Niederschrift anzulegen und zu archivieren</p>

                                <!-- $14 -->
                                <h5 class="text-center pb-2">§ 14 Auflösung des Clubs</h5>
                                <ol>
                                    <li>Der Club „Thüringer Tuning Freunde“ kann ausschließlich durch die Gründungsmitglieder aufgelöst werden.</li>
                                </ol>

                                <!-- $15 -->
                                <h5 class="text-center pb-2">§ 15 Haftung des Clubs</h5>
                                <ol>
                                    <li>Die Haftung in jeglichen Fragen wird auf die Gründungsmitglieder beschränkt. Eine Haftung der
                                        Clubmitglieder besteht nicht. (Nur bei grob fahrlässigen Verletzungen.)</li>
                                    <li>Die Haftung ist auf das Clubvermögen (aus Mitgliedsbeiträgen) beschränkt.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
