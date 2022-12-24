@extends('layouts.app')

@section('title', 'Datenschutz / Disclaimer')
@section('description')
    {{ strip_tags(Str::limit('Wir sind ein kleiner Marken offener Tuning Club'), 150) }}
@endsection
@section('robots', 'INDEX,FOLLOW')
@push('css')
    <style>
        .datenschutz {
            font-size: 1.25rem;
        }
    </style>
@endpush

@section('content')
    <section id="datenschutz" class="datenschutz container">

        <div class="row">
            <div class="col-lg-12">
                <h1>Datenschutzerklärung</h1>
                <h2 id="m14">Einleitung</h2>
                <p class="lead">Mit der folgenden Datenschutzerklärung möchten wir Sie darüber aufklären, welche Arten Ihrer
                    personenbezogenen Daten (nachfolgend auch kurz als "Daten“ bezeichnet) wir zu welchen Zwecken und in
                    welchem Umfang verarbeiten. Die Datenschutzerklärung gilt für alle von uns durchgeführten
                    Verarbeitungen personenbezogener Daten, sowohl im Rahmen der Erbringung unserer Leistungen als auch
                    insbesondere auf unseren Webseiten, in mobilen Applikationen sowie innerhalb externer
                    Onlinepräsenzen, wie z.B. unserer Social-Media-Profile (nachfolgend zusammenfassend bezeichnet als
                    "Onlineangebot“).</p>
                <p class="lead">Die verwendeten Begriffe sind nicht geschlechtsspezifisch.</p>
                <p class="lead">Stand: 30. Oktober 2022</p>
                <h2>Inhaltsübersicht</h2>
                <ul class="index">
                    <li><a class="index-link" href="#m14">Einleitung</a></li>
                    <li><a class="index-link" href="#m3">Verantwortlicher</a></li>
                    <li><a class="index-link" href="#mOverview">Übersicht der Verarbeitungen</a></li>
                    <li><a class="index-link" href="#m13">Maßgebliche Rechtsgrundlagen</a></li>
                    <li><a class="index-link" href="#m27">Sicherheitsmaßnahmen</a></li>
                    <li><a class="index-link" href="#m25">Übermittlung von personenbezogenen Daten</a></li>
                    <li><a class="index-link" href="#m24">Datenverarbeitung in Drittländern</a></li>
                    <li><a class="index-link" href="#m12">Löschung von Daten</a></li>
                    <li><a class="index-link" href="#m134">Einsatz von Cookies</a></li>
                    <li><a class="index-link" href="#m354">Wahrnehmung von Aufgaben nach Satzung oder Geschäftsordnung</a></li>
                    <li><a class="index-link" href="#m225">Bereitstellung des Onlineangebotes und Webhosting</a></li>
                    <li><a class="index-link" href="#m367">Registrierung, Anmeldung und Nutzerkonto</a></li>
                    <li><a class="index-link" href="#m182">Kontakt- und Anfragenverwaltung</a></li>
                    <li><a class="index-link" href="#m263">Webanalyse, Monitoring und Optimierung</a></li>
                    <li><a class="index-link" href="#m136">Präsenzen in sozialen Netzwerken (Social Media)</a></li>
                    <li><a class="index-link" href="#m328">Plugins und eingebettete Funktionen sowie Inhalte</a></li>
                    <li><a class="index-link" href="#m15">Änderung und Aktualisierung der Datenschutzerklärung</a></li>
                    <li><a class="index-link" href="#m10">Rechte der betroffenen Personen</a></li>
                    <li><a class="index-link" href="#m42">Begriffsdefinitionen</a></li>
                </ul>
                <h2 id="m3">Verantwortlicher</h2>
                <p class="lead">{{ env('TTF_NAME1') }} / {{ env('TTF_NAME') }}<br>
                    {{ env('TTF_STRASSE') }}<br>
                    {{ env('TTF_ORT') }}
                </p>
                <p class="lead">Vertretungsberechtigte Personen: {{ env('TTF_NAME1') }}</p>
                <p class="lead">E-Mail-Adresse: {{ env('TTF_EMAIL') }}</p>
                <p class="lead">Telefon: {{ env('TTF_TELEFON') }}</p>
                <p class="lead">Impressum: <a href="https://www.thueringer-tuning-freunde.de/impressum" target="_blank">https://www.thueringer-tuning-freunde.de/impressum</a>
                </p>
                <h2 id="mOverview">Übersicht der Verarbeitungen</h2>
                <p class="lead">Die nachfolgende Übersicht fasst die Arten der verarbeiteten Daten und die Zwecke ihrer Verarbeitung
                    zusammen und verweist auf die betroffenen Personen.</p>
                <h3>Arten der verarbeiteten Daten</h3>
                <ul>
                    <li>Bestandsdaten.</li>
                    <li>Zahlungsdaten.</li>
                    <li>Standortdaten.</li>
                    <li>Kontaktdaten.</li>
                    <li>Inhaltsdaten.</li>
                    <li>Vertragsdaten.</li>
                    <li>Nutzungsdaten.</li>
                    <li>Meta-/Kommunikationsdaten.</li>
                </ul>
                <h3>Kategorien betroffener Personen</h3>
                <ul>
                    <li>Kommunikationspartner.</li>
                    <li>Nutzer.</li>
                    <li>Mitglieder.</li>
                    <li>Geschäfts- und Vertragspartner.</li>
                </ul>
                <h3>Zwecke der Verarbeitung</h3>
                <ul>
                    <li>Erbringung vertraglicher Leistungen und Kundenservice.</li>
                    <li>Kontaktanfragen und Kommunikation.</li>
                    <li>Sicherheitsmaßnahmen.</li>
                    <li>Reichweitenmessung.</li>
                    <li>Tracking.</li>
                    <li>Verwaltung und Beantwortung von Anfragen.</li>
                    <li>Feedback.</li>
                    <li>Marketing.</li>
                    <li>Profile mit nutzerbezogenen Informationen.</li>
                    <li>Bereitstellung unseres Onlineangebotes und Nutzerfreundlichkeit.</li>
                    <li>Informationstechnische Infrastruktur.</li>
                </ul>
                <h3 id="m13">Maßgebliche Rechtsgrundlagen</h3>
                <p class="lead">Im Folgenden erhalten Sie eine Übersicht der Rechtsgrundlagen der DSGVO, auf deren Basis wir
                    personenbezogene Daten verarbeiten. Bitte nehmen Sie zur Kenntnis, dass neben den Regelungen der
                    DSGVO nationale Datenschutzvorgaben in Ihrem bzw. unserem Wohn- oder Sitzland gelten können. Sollten
                    ferner im Einzelfall speziellere Rechtsgrundlagen maßgeblich sein, teilen wir Ihnen diese in der
                    Datenschutzerklärung mit.</p>
                <ul>
                    <li><strong class="fw-bold">Einwilligung (Art. 6 Abs. 1 S. 1 lit. a) DSGVO)</strong> - Die betroffene Person hat
                        ihre Einwilligung in die Verarbeitung der sie betreffenden personenbezogenen Daten für einen
                        spezifischen Zweck oder mehrere bestimmte Zwecke gegeben.
                    </li>
                    <li><strong class="fw-bold">Vertragserfüllung und vorvertragliche Anfragen (Art. 6 Abs. 1 S. 1 lit. b)
                            DSGVO)</strong> - Die Verarbeitung ist für die Erfüllung eines Vertrags, dessen
                        Vertragspartei die betroffene Person ist, oder zur Durchführung vorvertraglicher Maßnahmen
                        erforderlich, die auf Anfrage der betroffenen Person erfolgen.
                    </li>
                    <li><strong class="fw-bold">Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f) DSGVO)</strong> - Die Verarbeitung
                        ist zur Wahrung der berechtigten Interessen des Verantwortlichen oder eines Dritten
                        erforderlich, sofern nicht die Interessen oder Grundrechte und Grundfreiheiten der betroffenen
                        Person, die den Schutz personenbezogener Daten erfordern, überwiegen.
                    </li>
                </ul>
                <p class="lead">Zusätzlich zu den Datenschutzregelungen der Datenschutz-Grundverordnung gelten nationale Regelungen
                    zum Datenschutz in Deutschland. Hierzu gehört insbesondere das Gesetz zum Schutz vor Missbrauch
                    personenbezogener Daten bei der Datenverarbeitung (Bundesdatenschutzgesetz – BDSG). Das BDSG enthält
                    insbesondere Spezialregelungen zum Recht auf Auskunft, zum Recht auf Löschung, zum
                    Widerspruchsrecht, zur Verarbeitung besonderer Kategorien personenbezogener Daten, zur Verarbeitung
                    für andere Zwecke und zur Übermittlung sowie automatisierten Entscheidungsfindung im Einzelfall
                    einschließlich Profiling. Des Weiteren regelt es die Datenverarbeitung für Zwecke des
                    Beschäftigungsverhältnisses (§ 26 BDSG), insbesondere im Hinblick auf die Begründung, Durchführung
                    oder Beendigung von Beschäftigungsverhältnissen sowie die Einwilligung von Beschäftigten. Ferner
                    können Landesdatenschutzgesetze der einzelnen Bundesländer zur Anwendung gelangen.</p>
                <h2 id="m27">Sicherheitsmaßnahmen</h2>
                <p class="lead">Wir treffen nach Maßgabe der gesetzlichen Vorgaben unter Berücksichtigung des Stands der Technik, der
                    Implementierungskosten und der Art, des Umfangs, der Umstände und der Zwecke der Verarbeitung sowie
                    der unterschiedlichen Eintrittswahrscheinlichkeiten und des Ausmaßes der Bedrohung der Rechte und
                    Freiheiten natürlicher Personen geeignete technische und organisatorische Maßnahmen, um ein dem
                    Risiko angemessenes Schutzniveau zu gewährleisten.</p>
                <p class="lead">Zu den Maßnahmen gehören insbesondere die Sicherung der Vertraulichkeit, Integrität und Verfügbarkeit
                    von Daten durch Kontrolle des physischen und elektronischen Zugangs zu den Daten als auch des sie
                    betreffenden Zugriffs, der Eingabe, der Weitergabe, der Sicherung der Verfügbarkeit und ihrer
                    Trennung. Des Weiteren haben wir Verfahren eingerichtet, die eine Wahrnehmung von
                    Betroffenenrechten, die Löschung von Daten und Reaktionen auf die Gefährdung der Daten
                    gewährleisten. Ferner berücksichtigen wir den Schutz personenbezogener Daten bereits bei der
                    Entwicklung bzw. Auswahl von Hardware, Software sowie Verfahren entsprechend dem Prinzip des
                    Datenschutzes, durch Technikgestaltung und durch datenschutzfreundliche Voreinstellungen.</p>
                <p class="lead">Kürzung der IP-Adresse: Sofern IP-Adressen von uns oder von den eingesetzten Dienstleistern und
                    Technologien verarbeitet werden und die Verarbeitung einer vollständigen IP-Adresse nicht
                    erforderlich ist, wird die IP-Adresse gekürzt (auch als "IP-Masking" bezeichnet). Hierbei werden die
                    letzten beiden Ziffern, bzw. der letzte Teil der IP-Adresse nach einem Punkt entfernt, bzw. durch
                    Platzhalter ersetzt. Mit der Kürzung der IP-Adresse soll die Identifizierung einer Person anhand
                    ihrer IP-Adresse verhindert oder wesentlich erschwert werden.</p>
                <p class="lead">TLS-Verschlüsselung (https): Um Ihre via unserem Online-Angebot übermittelten Daten zu schützen,
                    nutzen wir eine TLS-Verschlüsselung. Sie erkennen derart verschlüsselte Verbindungen an dem Präfix
                    https:// in der Adresszeile Ihres Browsers.</p>
                <h2 id="m25">Übermittlung von personenbezogenen Daten</h2>
                <p class="lead">Im Rahmen unserer Verarbeitung von personenbezogenen Daten kommt es vor, dass die Daten an andere
                    Stellen, Unternehmen, rechtlich selbstständige Organisationseinheiten oder Personen übermittelt oder
                    sie ihnen gegenüber offengelegt werden. Zu den Empfängern dieser Daten können z.B. mit IT-Aufgaben
                    beauftragte Dienstleister oder Anbieter von Diensten und Inhalten, die in eine Webseite eingebunden
                    werden, gehören. In solchen Fall beachten wir die gesetzlichen Vorgaben und schließen insbesondere
                    entsprechende Verträge bzw. Vereinbarungen, die dem Schutz Ihrer Daten dienen, mit den Empfängern
                    Ihrer Daten ab.</p>
                <h2 id="m24">Datenverarbeitung in Drittländern</h2>
                <p class="lead">Sofern wir Daten in einem Drittland (d.h., außerhalb der Europäischen Union (EU), des Europäischen
                    Wirtschaftsraums (EWR)) verarbeiten oder die Verarbeitung im Rahmen der Inanspruchnahme von Diensten
                    Dritter oder der Offenlegung bzw. Übermittlung von Daten an andere Personen, Stellen oder
                    Unternehmen stattfindet, erfolgt dies nur im Einklang mit den gesetzlichen Vorgaben. </p>
                <p class="lead">Vorbehaltlich ausdrücklicher Einwilligung oder vertraglich oder gesetzlich erforderlicher
                    Übermittlung verarbeiten oder lassen wir die Daten nur in Drittländern mit einem anerkannten
                    Datenschutzniveau, vertraglichen Verpflichtung durch sogenannte Standardschutzklauseln der
                    EU-Kommission, beim Vorliegen von Zertifizierungen oder verbindlicher internen
                    Datenschutzvorschriften verarbeiten (Art. 44 bis 49 DSGVO, Informationsseite der EU-Kommission:
                    <a href="https://ec.europa.eu/info/law/law-topic/data-protection/international-dimension-data-protection_de" target="_blank">https://ec.europa.eu/info/law/law-topic/data-protection/international-dimension-data-protection_de</a>).
                </p>
                <h2 id="m12">Löschung von Daten</h2>
                <p class="lead">Die von uns verarbeiteten Daten werden nach Maßgabe der gesetzlichen Vorgaben gelöscht, sobald deren
                    zur Verarbeitung erlaubten Einwilligungen widerrufen werden oder sonstige Erlaubnisse entfallen
                    (z.B. wenn der Zweck der Verarbeitung dieser Daten entfallen ist oder sie für den Zweck nicht
                    erforderlich sind). Sofern die Daten nicht gelöscht werden, weil sie für andere und gesetzlich
                    zulässige Zwecke erforderlich sind, wird deren Verarbeitung auf diese Zwecke beschränkt. D.h., die
                    Daten werden gesperrt und nicht für andere Zwecke verarbeitet. Das gilt z.B. für Daten, die aus
                    handels- oder steuerrechtlichen Gründen aufbewahrt werden müssen oder deren Speicherung zur
                    Geltendmachung, Ausübung oder Verteidigung von Rechtsansprüchen oder zum Schutz der Rechte einer
                    anderen natürlichen oder juristischen Person erforderlich ist. </p>
                <p class="lead">Unsere Datenschutzhinweise können ferner weitere Angaben zu der Aufbewahrung und Löschung von Daten
                    beinhalten, die für die jeweiligen Verarbeitungen vorrangig gelten.</p>
                <h2 id="m134">Einsatz von Cookies</h2>
                <p class="lead">Cookies sind kleine Textdateien, bzw. sonstige Speichervermerke, die Informationen auf Endgeräten
                    speichern und Informationen aus den Endgeräten auslesen. Z.B. um den Login-Status in einem
                    Nutzerkonto, einen Warenkorbinhalt in einem E-Shop, die aufgerufenen Inhalte oder verwendete
                    Funktionen eines Onlineangebotes speichern. Cookies können ferner zu unterschiedlichen Zwecken
                    eingesetzt werden, z.B. zu Zwecken der Funktionsfähigkeit, Sicherheit und Komfort von
                    Onlineangeboten sowie der Erstellung von Analysen der Besucherströme. </p>
                <p class="lead"><strong class="fw-bold">Hinweise zur Einwilligung: </strong>Wir setzen Cookies im Einklang mit den gesetzlichen
                    Vorschriften ein. Daher holen wir von den Nutzern eine vorhergehende Einwilligung ein, außer wenn
                    diese gesetzlich nicht gefordert ist. Eine Einwilligung ist insbesondere nicht notwendig, wenn das
                    Speichern und das Auslesen der Informationen, also auch von Cookies, unbedingt erforderlich sind, um
                    dem den Nutzern einen von ihnen ausdrücklich gewünschten Telemediendienst (also unser Onlineangebot)
                    zur Verfügung zu stellen. Die widerrufliche Einwilligung wird gegenüber den Nutzern deutlich
                    kommuniziert und enthält die Informationen zu der jeweiligen Cookie-Nutzung.</p>
                <p class="lead"><strong class="fw-bold">Hinweise zu datenschutzrechtlichen Rechtsgrundlagen: </strong>Auf welcher
                    datenschutzrechtlichen Rechtsgrundlage wir die personenbezogenen Daten der Nutzer mit Hilfe von
                    Cookies verarbeiten, hängt davon ab, ob wir Nutzer um eine Einwilligung bitten. Falls die Nutzer
                    einwilligen, ist die Rechtsgrundlage der Verarbeitung Ihrer Daten die erklärte Einwilligung.
                    Andernfalls werden die mithilfe von Cookies verarbeiteten Daten auf Grundlage unserer berechtigten
                    Interessen (z.B. an einem betriebswirtschaftlichen Betrieb unseres Onlineangebotes und Verbesserung
                    seiner Nutzbarkeit) verarbeitet oder, wenn dies im Rahmen der Erfüllung unserer vertraglichen
                    Pflichten erfolgt, wenn der Einsatz von Cookies erforderlich ist, um unsere vertraglichen
                    Verpflichtungen zu erfüllen. Zu welchen Zwecken die Cookies von uns verarbeitet werden, darüber
                    klären wir im Laufe dieser Datenschutzerklärung oder im Rahmen von unseren Einwilligungs- und
                    Verarbeitungsprozessen auf.</p>
                <p class="lead"><strong class="fw-bold">Speicherdauer: </strong>Im Hinblick auf die Speicherdauer werden die folgenden Arten von
                    Cookies unterschieden:</p>
                <ul>
                    <li><strong class="fw-bold">Temporäre Cookies (auch: Session- oder Sitzungs-Cookies):</strong> Temporäre Cookies
                        werden spätestens gelöscht, nachdem ein Nutzer ein Online-Angebot verlassen und sein Endgerät
                        (z.B. Browser oder mobile Applikation) geschlossen hat.
                    </li>
                    <li><strong class="fw-bold">Permanente Cookies:</strong> Permanente Cookies bleiben auch nach dem Schließen des
                        Endgerätes gespeichert. So können beispielsweise der Login-Status gespeichert oder bevorzugte
                        Inhalte direkt angezeigt werden, wenn der Nutzer eine Website erneut besucht. Ebenso können die
                        mit Hilfe von Cookies erhobenen Daten der Nutzer zur Reichweitenmessung verwendet werden. Sofern
                        wir Nutzern keine expliziten Angaben zur Art und Speicherdauer von Cookies mitteilen (z. B. im
                        Rahmen der Einholung der Einwilligung), sollten Nutzer davon ausgehen, dass Cookies permanent
                        sind und die Speicherdauer bis zu zwei Jahre betragen kann.
                    </li>
                </ul>
                <p class="lead"><strong class="fw-bold">Allgemeine Hinweise zum Widerruf und Widerspruch (Opt-Out): </strong>Nutzer können die von
                    ihnen abgegebenen Einwilligungen jederzeit widerrufen und zudem einen Widerspruch gegen die
                    Verarbeitung entsprechend den gesetzlichen Vorgaben im Art. 21 DSGVO einlegen. Nutzer können ihren
                    Widerspruch auch über die Einstellungen ihres Browsers erklären, z.B. durch Deaktivierung der
                    Verwendung von Cookies (wobei dadurch auch die Funktionalität unserer Online-Dienste eingeschränkt
                    sein kann). Ein Widerspruch gegen die Verwendung von Cookies zu Online-Marketing-Zwecken kann auch
                    über die Websites <a href="https://optout.aboutads.info" target="_blank">https://optout.aboutads.info</a>
                    und
                    <a href="https://www.youronlinechoices.com/" target="_blank">https://www.youronlinechoices.com/</a>
                    erklärt werden.</p>
                <strong class="fw-bold">Cookie-Einstellungen/ -Widerspruchsmöglichkeit:</strong>
                <p class="lead"></p>
                <p class="lead"><strong class="fw-bold">Weitere Hinweise zu Verarbeitungsprozessen, Verfahren und Diensten:</strong></p>
                <ul class="m-elements">
                    <li><strong class="fw-bold">Verarbeitung von Cookie-Daten auf Grundlage einer Einwilligung: </strong>Wir setzen ein
                        Verfahren zum Cookie-Einwilligungs-Management ein, in dessen Rahmen die Einwilligungen der
                        Nutzer in den Einsatz von Cookies, bzw. der im Rahmen des
                        Cookie-Einwilligungs-Management-Verfahrens genannten Verarbeitungen und Anbieter eingeholt sowie
                        von den Nutzern verwaltet und widerrufen werden können. Hierbei wird die Einwilligungserklärung
                        gespeichert, um deren Abfrage nicht erneut wiederholen zu müssen und die Einwilligung
                        entsprechend der gesetzlichen Verpflichtung nachweisen zu können. Die Speicherung kann
                        serverseitig und/oder in einem Cookie (sogenanntes Opt-In-Cookie, bzw. mithilfe vergleichbarer
                        Technologien) erfolgen, um die Einwilligung einem Nutzer, bzw. dessen Gerät zuordnen zu können.
                        Vorbehaltlich individueller Angaben zu den Anbietern von Cookie-Management-Diensten, gelten die
                        folgenden Hinweise: Die Dauer der Speicherung der Einwilligung kann bis zu zwei Jahren betragen.
                        Hierbei wird ein pseudonymer Nutzer-Identifikator gebildet und mit dem Zeitpunkt der
                        Einwilligung, Angaben zur Reichweite der Einwilligung (z. B. welche Kategorien von Cookies
                        und/oder Diensteanbieter) sowie dem Browser, System und verwendeten Endgerät gespeichert.
                    </li>
                </ul>
                <h2 id="m354">Wahrnehmung von Aufgaben nach Satzung oder Geschäftsordnung</h2>
                <p class="lead">Wir verarbeiten die Daten unserer Mitglieder, Unterstützer, Interessenten, Geschäftspartner oder
                    sonstiger Personen (Zusammenfassend "Betroffene"), wenn wir mit ihnen in einem Mitgliedschafts- oder
                    sonstigem geschäftlichen Verhältnis stehen und unsere Aufgaben wahrnehmen sowie Empfänger von
                    Leistungen und Zuwendungen sind. Im Übrigen verarbeiten wir die Daten Betroffener auf Grundlage
                    unserer berechtigten Interessen, z.B. wenn es sich um administrative Aufgaben oder
                    Öffentlichkeitsarbeit handelt.</p>
                <p class="lead">Die hierbei verarbeiteten Daten, die Art, der Umfang und der Zweck und die Erforderlichkeit ihrer
                    Verarbeitung, bestimmen sich nach dem zugrundeliegenden Mitgliedschafts- oder Vertragsverhältnis,
                    aus dem sich auch die Erforderlichkeit etwaiger Datenangaben ergeben (im Übrigen weisen wir auf
                    erforderliche Daten hin).</p>
                <p class="lead">Wir löschen Daten, die zur Erbringung unserer satzungs- und geschäftsmäßigen Zwecke nicht mehr
                    erforderlich sind. Dies bestimmt sich entsprechend der jeweiligen Aufgaben und vertraglichen
                    Beziehungen. Wir bewahren die Daten so lange auf, wie sie zur Geschäftsabwicklung, als auch im
                    Hinblick auf etwaige Gewährleistungs- oder Haftungspflichten auf Grundlage unserer berechtigten
                    Interesse an deren Regelung relevant sein können. Die Erforderlichkeit der Aufbewahrung der Daten
                    wird regelmäßig überprüft; im Übrigen gelten die gesetzlichen Aufbewahrungspflichten.</p>
                <ul class="m-elements">
                    <li><strong class="fw-bold">Verarbeitete Datenarten:</strong> Bestandsdaten (z.B. Namen, Adressen); Zahlungsdaten
                        (z.B. Bankverbindungen, Rechnungen, Zahlungshistorie); Kontaktdaten (z.B. E-Mail,
                        Telefonnummern); Vertragsdaten (z.B. Vertragsgegenstand, Laufzeit, Kundenkategorie).
                    </li>
                    <li><strong class="fw-bold">Betroffene Personen:</strong> Nutzer (z.B. Webseitenbesucher, Nutzer von
                        Onlinediensten); Mitglieder; Geschäfts- und Vertragspartner.
                    </li>
                    <li><strong class="fw-bold">Zwecke der Verarbeitung:</strong> Erbringung vertraglicher Leistungen und Kundenservice;
                        Kontaktanfragen und Kommunikation; Verwaltung und Beantwortung von Anfragen.
                    </li>
                    <li><strong class="fw-bold">Rechtsgrundlagen:</strong> Vertragserfüllung und vorvertragliche Anfragen (Art. 6 Abs. 1
                        S. 1 lit. b) DSGVO); Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f) DSGVO).
                    </li>
                </ul>
                <h2 id="m225">Bereitstellung des Onlineangebotes und Webhosting</h2>
                <p class="lead">Wir verarbeiten die Daten der Nutzer, um ihnen unsere Online-Dienste zur Verfügung stellen zu können.
                    Zu diesem Zweck verarbeiten wir die IP-Adresse des Nutzers, die notwendig ist, um die Inhalte und
                    Funktionen unserer Online-Dienste an den Browser oder das Endgerät der Nutzer zu übermitteln.</p>
                <ul class="m-elements">
                    <li><strong class="fw-bold">Verarbeitete Datenarten:</strong> Nutzungsdaten (z.B. besuchte Webseiten, Interesse an
                        Inhalten, Zugriffszeiten); Meta-/Kommunikationsdaten (z.B. Geräte-Informationen, IP-Adressen);
                        Inhaltsdaten (z.B. Eingaben in Onlineformularen).
                    </li>
                    <li><strong class="fw-bold">Betroffene Personen:</strong> Nutzer (z.B. Webseitenbesucher, Nutzer von
                        Onlinediensten).
                    </li>
                    <li><strong class="fw-bold">Zwecke der Verarbeitung:</strong> Bereitstellung unseres Onlineangebotes und
                        Nutzerfreundlichkeit; Informationstechnische Infrastruktur (Betrieb und Bereitstellung von
                        Informationssystemen und technischen Geräten (Computer, Server etc.).); Sicherheitsmaßnahmen.
                    </li>
                    <li><strong class="fw-bold">Rechtsgrundlagen:</strong> Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f) DSGVO).
                    </li>
                </ul>
                <p class="lead"><strong class="fw-bold">Weitere Hinweise zu Verarbeitungsprozessen, Verfahren und Diensten:</strong></p>
                <ul class="m-elements">
                    <li><strong class="fw-bold">Bereitstellung Onlineangebot auf gemietetem Speicherplatz: </strong>Für die
                        Bereitstellung unseres Onlineangebotes nutzen wir Speicherplatz, Rechenkapazität und Software,
                        die wir von einem entsprechenden Serveranbieter (auch "Webhoster" genannt) mieten oder
                        anderweitig beziehen; <strong class="fw-bold">Rechtsgrundlagen:</strong> Berechtigte Interessen (Art. 6 Abs. 1
                        S. 1 lit. f) DSGVO).
                    </li>
                    <li><strong class="fw-bold">Bereitstellung Onlineangebot auf eigener/ dedizierter Serverhardware: </strong>Für die
                        Bereitstellung unseres Onlineangebotes nutzen wir von uns betriebene Serverhardware sowie den
                        damit verbundenen Speicherplatz, die Rechenkapazität und die Software;
                        <strong class="fw-bold">Rechtsgrundlagen:</strong> Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f) DSGVO).
                    </li>
                    <li><strong class="fw-bold">Erhebung von Zugriffsdaten und Logfiles: </strong>Der Zugriff auf unser Onlineangebot
                        wird in Form von so genannten "Server-Logfiles" protokolliert. Zu den Serverlogfiles können die
                        Adresse und Name der abgerufenen Webseiten und Dateien, Datum und Uhrzeit des Abrufs,
                        übertragene Datenmengen, Meldung über erfolgreichen Abruf, Browsertyp nebst Version, das
                        Betriebssystem des Nutzers, Referrer URL (die zuvor besuchte Seite) und im Regelfall IP-Adressen
                        und der anfragende Provider gehören.

                        Die Serverlogfiles können zum einen zu Zwecken der Sicherheit eingesetzt werden, z.B., um eine
                        Überlastung der Server zu vermeiden (insbesondere im Fall von missbräuchlichen Angriffen,
                        sogenannten DDoS-Attacken) und zum anderen, um die Auslastung der Server und ihre Stabilität
                        sicherzustellen; <strong class="fw-bold">Rechtsgrundlagen:</strong> Berechtigte Interessen (Art. 6 Abs. 1 S. 1
                        lit. f) DSGVO); <strong class="fw-bold">Löschung von Daten:</strong> Logfile-Informationen werden für die Dauer
                        von maximal 30 Tagen gespeichert und danach gelöscht oder anonymisiert. Daten, deren weitere
                        Aufbewahrung zu Beweiszwecken erforderlich ist, sind bis zur endgültigen Klärung des jeweiligen
                        Vorfalls von der Löschung ausgenommen.
                    </li>
                    <li><strong class="fw-bold">E-Mail-Versand und -Hosting: </strong>Die von uns in Anspruch genommenen
                        Webhosting-Leistungen umfassen ebenfalls den Versand, den Empfang sowie die Speicherung von
                        E-Mails. Zu diesen Zwecken werden die Adressen der Empfänger sowie Absender als auch weitere
                        Informationen betreffend den E-Mailversand (z.B. die beteiligten Provider) sowie die Inhalte der
                        jeweiligen E-Mails verarbeitet. Die vorgenannten Daten können ferner zu Zwecken der Erkennung
                        von SPAM verarbeitet werden. Wir bitten darum, zu beachten, dass E-Mails im Internet
                        grundsätzlich nicht verschlüsselt versendet werden. Im Regelfall werden E-Mails zwar auf dem
                        Transportweg verschlüsselt, aber (sofern kein sogenanntes Ende-zu-Ende-Verschlüsselungsverfahren
                        eingesetzt wird) nicht auf den Servern, von denen sie abgesendet und empfangen werden. Wir
                        können daher für den Übertragungsweg der E-Mails zwischen dem Absender und dem Empfang auf
                        unserem Server keine Verantwortung übernehmen; <strong class="fw-bold">Rechtsgrundlagen:</strong> Berechtigte
                        Interessen (Art. 6 Abs. 1 S. 1 lit. f) DSGVO).
                    </li>
                    <li><strong class="fw-bold">Content-Delivery-Network: </strong>Wir setzen ein "Content-Delivery-Network" (CDN) ein.
                        Ein CDN ist ein Dienst, mit dessen Hilfe Inhalte eines Onlineangebotes, insbesondere große
                        Mediendateien, wie Grafiken oder Programm-Skripte, mit Hilfe regional verteilter und über das
                        Internet verbundener Server schneller und sicherer ausgeliefert werden können; <strong class="fw-bold">Rechtsgrundlagen:</strong>
                        Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f) DSGVO).
                    </li>
                </ul>
                <h2 id="m367">Registrierung, Anmeldung und Nutzerkonto</h2>
                <p class="lead">Nutzer können ein Nutzerkonto anlegen. Im Rahmen der Registrierung werden den Nutzern die
                    erforderlichen Pflichtangaben mitgeteilt und zu Zwecken der Bereitstellung des Nutzerkontos auf
                    Grundlage vertraglicher Pflichterfüllung verarbeitet. Zu den verarbeiteten Daten gehören
                    insbesondere die Login-Informationen (Nutzername, Passwort sowie eine E-Mail-Adresse).</p>
                <p class="lead">Im Rahmen der Inanspruchnahme unserer Registrierungs- und Anmeldefunktionen sowie der Nutzung des
                    Nutzerkontos speichern wir die IP-Adresse und den Zeitpunkt der jeweiligen Nutzerhandlung. Die
                    Speicherung erfolgt auf Grundlage unserer berechtigten Interessen als auch jener der Nutzer an einem
                    Schutz vor Missbrauch und sonstiger unbefugter Nutzung. Eine Weitergabe dieser Daten an Dritte
                    erfolgt grundsätzlich nicht, es sei denn, sie ist zur Verfolgung unserer Ansprüche erforderlich oder
                    es besteht eine gesetzliche Verpflichtung hierzu.</p>
                <p class="lead">Die Nutzer können über Vorgänge, die für deren Nutzerkonto relevant sind, wie z.B. technische
                    Änderungen, per E-Mail informiert werden.</p>
                <ul class="m-elements">
                    <li><strong class="fw-bold">Verarbeitete Datenarten:</strong> Bestandsdaten (z.B. Namen, Adressen); Kontaktdaten
                        (z.B. E-Mail, Telefonnummern); Inhaltsdaten (z.B. Eingaben in Onlineformularen);
                        Meta-/Kommunikationsdaten (z.B. Geräte-Informationen, IP-Adressen).
                    </li>
                    <li><strong class="fw-bold">Betroffene Personen:</strong> Nutzer (z.B. Webseitenbesucher, Nutzer von
                        Onlinediensten).
                    </li>
                    <li><strong class="fw-bold">Zwecke der Verarbeitung:</strong> Erbringung vertraglicher Leistungen und Kundenservice;
                        Sicherheitsmaßnahmen; Verwaltung und Beantwortung von Anfragen; Bereitstellung unseres
                        Onlineangebotes und Nutzerfreundlichkeit.
                    </li>
                    <li><strong class="fw-bold">Rechtsgrundlagen:</strong> Vertragserfüllung und vorvertragliche Anfragen (Art. 6 Abs. 1
                        S. 1 lit. b) DSGVO); Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f) DSGVO).
                    </li>
                </ul>
                <p class="lead"><strong class="fw-bold">Weitere Hinweise zu Verarbeitungsprozessen, Verfahren und Diensten:</strong></p>
                <ul class="m-elements">
                    <li><strong class="fw-bold">Registrierung mit Klarnamen: </strong>Aufgrund der Natur unserer Community bitten wir
                        die Nutzer unser Angebot nur unter Verwendung von Klarnamen zu nutzen. D.h. die Nutzung von
                        Pseudonymen ist nicht zulässig; <strong class="fw-bold">Rechtsgrundlagen:</strong> Vertragserfüllung und
                        vorvertragliche Anfragen (Art. 6 Abs. 1 S. 1 lit. b) DSGVO).
                    </li>
                    <li><strong class="fw-bold">Profile der Nutzer sind öffentlich: </strong>Die Profile der Nutzer sind öffentlich
                        sichtbar und zugänglich; <strong class="fw-bold">Rechtsgrundlagen:</strong> Vertragserfüllung und
                        vorvertragliche Anfragen (Art. 6 Abs. 1 S. 1 lit. b) DSGVO).
                    </li>
                    <li><strong class="fw-bold">Löschung von Daten nach Kündigung: </strong>Wenn Nutzer ihr Nutzerkonto gekündigt haben,
                        werden deren Daten im Hinblick auf das Nutzerkonto, vorbehaltlich einer gesetzlichen Erlaubnis,
                        Pflicht oder Einwilligung der Nutzer, gelöscht; <strong class="fw-bold">Rechtsgrundlagen:</strong>
                        Vertragserfüllung und vorvertragliche Anfragen (Art. 6 Abs. 1 S. 1 lit. b) DSGVO).
                    </li>
                    <li><strong class="fw-bold">Keine Aufbewahrungspflicht für Daten: </strong>Es obliegt den Nutzern, ihre Daten bei
                        erfolgter Kündigung vor dem Vertragsende zu sichern. Wir sind berechtigt, sämtliche während der
                        Vertragsdauer gespeicherte Daten des Nutzers unwiederbringlich zu löschen; <strong class="fw-bold">Rechtsgrundlagen:</strong>
                        Vertragserfüllung und vorvertragliche Anfragen (Art. 6 Abs. 1 S. 1 lit. b) DSGVO).
                    </li>
                </ul>
                <h2 id="m182">Kontakt- und Anfragenverwaltung</h2>
                <p class="lead">Bei der Kontaktaufnahme mit uns (z.B. per Kontaktformular, E-Mail, Telefon oder via soziale Medien)
                    sowie im Rahmen bestehender Nutzer- und Geschäftsbeziehungen werden die Angaben der anfragenden
                    Personen verarbeitet soweit dies zur Beantwortung der Kontaktanfragen und etwaiger angefragter
                    Maßnahmen erforderlich ist.</p>
                <ul class="m-elements">
                    <li><strong class="fw-bold">Verarbeitete Datenarten:</strong> Kontaktdaten (z.B. E-Mail, Telefonnummern);
                        Inhaltsdaten (z.B. Eingaben in Onlineformularen); Nutzungsdaten (z.B. besuchte Webseiten,
                        Interesse an Inhalten, Zugriffszeiten); Meta-/Kommunikationsdaten (z.B. Geräte-Informationen,
                        IP-Adressen).
                    </li>
                    <li><strong class="fw-bold">Betroffene Personen:</strong> Kommunikationspartner.</li>
                    <li><strong class="fw-bold">Zwecke der Verarbeitung:</strong> Kontaktanfragen und Kommunikation; Verwaltung und
                        Beantwortung von Anfragen; Feedback (z.B. Sammeln von Feedback via Online-Formular);
                        Bereitstellung unseres Onlineangebotes und Nutzerfreundlichkeit.
                    </li>
                    <li><strong class="fw-bold">Rechtsgrundlagen:</strong> Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f) DSGVO);
                        Vertragserfüllung und vorvertragliche Anfragen (Art. 6 Abs. 1 S. 1 lit. b) DSGVO).
                    </li>
                </ul>
                <p class="lead"><strong class="fw-bold">Weitere Hinweise zu Verarbeitungsprozessen, Verfahren und Diensten:</strong></p>
                <ul class="m-elements">
                    <li><strong class="fw-bold">Kontaktformular: </strong>Wenn Nutzer über unser Kontaktformular, E-Mail oder andere
                        Kommunikationswege mit uns in Kontakt treten, verarbeiten wir die uns in diesem Zusammenhang
                        mitgeteilten Daten zur Bearbeitung des mitgeteilten Anliegens;
                        <strong class="fw-bold">Rechtsgrundlagen:</strong> Vertragserfüllung und vorvertragliche Anfragen (Art. 6 Abs. 1
                        S. 1 lit. b) DSGVO), Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f) DSGVO).
                    </li>
                </ul>
                <h2 id="m263">Webanalyse, Monitoring und Optimierung</h2>
                <p class="lead">Die Webanalyse (auch als "Reichweitenmessung" bezeichnet) dient der Auswertung der Besucherströme
                    unseres Onlineangebotes und kann Verhalten, Interessen oder demographische Informationen zu den
                    Besuchern, wie z.B. das Alter oder das Geschlecht, als pseudonyme Werte umfassen. Mit Hilfe der
                    Reichweitenanalyse können wir z.B. erkennen, zu welcher Zeit unser Onlineangebot oder dessen
                    Funktionen oder Inhalte am häufigsten genutzt werden oder zur Wiederverwendung einladen. Ebenso
                    können wir nachvollziehen, welche Bereiche der Optimierung bedürfen. </p>
                <p class="lead">Neben der Webanalyse können wir auch Testverfahren einsetzen, um z.B. unterschiedliche Versionen
                    unseres Onlineangebotes oder seiner Bestandteile zu testen und optimieren.</p>
                <p class="lead">Sofern nachfolgend nicht anders angegeben, können zu diesen Zwecken Profile, d.h. zu einem
                    Nutzungsvorgang zusammengefasste Daten angelegt und Informationen in einem Browser, bzw. in einem
                    Endgerät gespeichert und aus diesem ausgelesen werden. Zu den erhobenen Angaben gehören insbesondere
                    besuchte Webseiten und dort genutzte Elemente sowie technische Angaben, wie der verwendete Browser,
                    das verwendete Computersystem sowie Angaben zu Nutzungszeiten. Sofern Nutzer in die Erhebung ihrer
                    Standortdaten uns gegenüber oder gegenüber den Anbietern der von uns eingesetzten Dienste
                    einverstanden erklärt haben, können auch Standortdaten verarbeitet werden.</p>
                <p class="lead">Es werden ebenfalls die IP-Adressen der Nutzer gespeichert. Jedoch nutzen wir ein
                    IP-Masking-Verfahren (d.h., Pseudonymisierung durch Kürzung der IP-Adresse) zum Schutz der Nutzer.
                    Generell werden die im Rahmen von Webanalyse, A/B-Testings und Optimierung keine Klardaten der
                    Nutzer (wie z.B. E-Mail-Adressen oder Namen) gespeichert, sondern Pseudonyme. D.h., wir als auch die
                    Anbieter der eingesetzten Software kennen nicht die tatsächliche Identität der Nutzer, sondern nur
                    den für Zwecke der jeweiligen Verfahren in deren Profilen gespeicherten Angaben.</p>
                <ul class="m-elements">
                    <li><strong class="fw-bold">Verarbeitete Datenarten:</strong> Nutzungsdaten (z.B. besuchte Webseiten, Interesse an
                        Inhalten, Zugriffszeiten); Meta-/Kommunikationsdaten (z.B. Geräte-Informationen, IP-Adressen).
                    </li>
                    <li><strong class="fw-bold">Betroffene Personen:</strong> Nutzer (z.B. Webseitenbesucher, Nutzer von
                        Onlinediensten).
                    </li>
                    <li><strong class="fw-bold">Zwecke der Verarbeitung:</strong> Reichweitenmessung (z.B. Zugriffsstatistiken,
                        Erkennung wiederkehrender Besucher); Profile mit nutzerbezogenen Informationen (Erstellen von
                        Nutzerprofilen); Tracking (z.B. interessens-/verhaltensbezogenes Profiling, Nutzung von
                        Cookies); Bereitstellung unseres Onlineangebotes und Nutzerfreundlichkeit.
                    </li>
                    <li><strong class="fw-bold">Sicherheitsmaßnahmen:</strong> IP-Masking (Pseudonymisierung der IP-Adresse).</li>
                    <li><strong class="fw-bold">Rechtsgrundlagen:</strong> Einwilligung (Art. 6 Abs. 1 S. 1 lit. a) DSGVO).</li>
                </ul>
                <p class="lead"><strong class="fw-bold">Weitere Hinweise zu Verarbeitungsprozessen, Verfahren und Diensten:</strong></p>
                <ul class="m-elements">
                    <li><strong class="fw-bold">Google Analytics: </strong>Webanalyse, Reichweitenmessung sowie Messung von
                        Nutzerströmen; <strong class="fw-bold">Dienstanbieter:</strong> Google Ireland Limited, Gordon House, Barrow
                        Street, Dublin 4, Irland; <strong class="fw-bold">Rechtsgrundlagen:</strong> Einwilligung (Art. 6 Abs. 1 S. 1
                        lit. a) DSGVO); <strong class="fw-bold">Website:</strong>
                        <a href="https://marketingplatform.google.com/intl/de/about/analytics/" target="_blank">https://marketingplatform.google.com/intl/de/about/analytics/</a>;
                        <strong class="fw-bold">Datenschutzerklärung:</strong>
                        <a href="https://policies.google.com/privacy" target="_blank">https://policies.google.com/privacy</a>;
                        <strong class="fw-bold">Auftragsverarbeitungsvertrag:</strong>
                        <a href="https://business.safety.google/adsprocessorterms" target="_blank">https://business.safety.google/adsprocessorterms</a>;
                        <strong class="fw-bold">Standardvertragsklauseln (Gewährleistung Datenschutzniveau bei Verarbeitung in
                            Drittländern):</strong>
                        <a href="https://business.safety.google/adsprocessorterms" target="_blank">https://business.safety.google/adsprocessorterms</a>;
                        <strong class="fw-bold">Widerspruchsmöglichkeit (Opt-Out):</strong> Opt-Out-Plugin:
                        <a href="https://tools.google.com/dlpage/gaoptout?hl=de" target="_blank">https://tools.google.com/dlpage/gaoptout?hl=de</a>,
                        Einstellungen für die Darstellung von Werbeeinblendungen:
                        <a href="https://adssettings.google.com/authenticated" target="_blank">https://adssettings.google.com/authenticated</a>;
                        <strong class="fw-bold">Weitere Informationen:</strong>
                        <a href="https://privacy.google.com/businesses/adsservices" target="_blank">https://privacy.google.com/businesses/adsservices</a>
                        (Arten der Verarbeitung sowie der verarbeiteten Daten).
                    </li>
                </ul>
                <h2 id="m136">Präsenzen in sozialen Netzwerken (Social Media)</h2>
                <p class="lead">Wir unterhalten Onlinepräsenzen innerhalb sozialer Netzwerke und verarbeiten in diesem Rahmen Daten
                    der Nutzer, um mit den dort aktiven Nutzern zu kommunizieren oder um Informationen über uns
                    anzubieten.</p>
                <p class="lead">Wir weisen darauf hin, dass dabei Daten der Nutzer außerhalb des Raumes der Europäischen Union
                    verarbeitet werden können. Hierdurch können sich für die Nutzer Risiken ergeben, weil so z.B. die
                    Durchsetzung der Rechte der Nutzer erschwert werden könnte.</p>
                <p class="lead">Ferner werden die Daten der Nutzer innerhalb sozialer Netzwerke im Regelfall für Marktforschungs- und
                    Werbezwecke verarbeitet. So können z.B. anhand des Nutzungsverhaltens und sich daraus ergebender
                    Interessen der Nutzer Nutzungsprofile erstellt werden. Die Nutzungsprofile können wiederum verwendet
                    werden, um z.B. Werbeanzeigen innerhalb und außerhalb der Netzwerke zu schalten, die mutmaßlich den
                    Interessen der Nutzer entsprechen. Zu diesen Zwecken werden im Regelfall Cookies auf den Rechnern
                    der Nutzer gespeichert, in denen das Nutzungsverhalten und die Interessen der Nutzer gespeichert
                    werden. Ferner können in den Nutzungsprofilen auch Daten unabhängig der von den Nutzern verwendeten
                    Geräte gespeichert werden (insbesondere, wenn die Nutzer Mitglieder der jeweiligen Plattformen sind
                    und bei diesen eingeloggt sind).</p>
                <p class="lead">Für eine detaillierte Darstellung der jeweiligen Verarbeitungsformen und der
                    Widerspruchsmöglichkeiten (Opt-Out) verweisen wir auf die Datenschutzerklärungen und Angaben der
                    Betreiber der jeweiligen Netzwerke.</p>
                <p class="lead">Auch im Fall von Auskunftsanfragen und der Geltendmachung von Betroffenenrechten weisen wir darauf
                    hin, dass diese am effektivsten bei den Anbietern geltend gemacht werden können. Nur die Anbieter
                    haben jeweils Zugriff auf die Daten der Nutzer und können direkt entsprechende Maßnahmen ergreifen
                    und Auskünfte geben. Sollten Sie dennoch Hilfe benötigen, dann können Sie sich an uns wenden.</p>
                <ul class="m-elements">
                    <li><strong class="fw-bold">Verarbeitete Datenarten:</strong> Kontaktdaten (z.B. E-Mail, Telefonnummern);
                        Inhaltsdaten (z.B. Eingaben in Onlineformularen); Nutzungsdaten (z.B. besuchte Webseiten,
                        Interesse an Inhalten, Zugriffszeiten); Meta-/Kommunikationsdaten (z.B. Geräte-Informationen,
                        IP-Adressen).
                    </li>
                    <li><strong class="fw-bold">Betroffene Personen:</strong> Nutzer (z.B. Webseitenbesucher, Nutzer von
                        Onlinediensten).
                    </li>
                    <li><strong class="fw-bold">Zwecke der Verarbeitung:</strong> Kontaktanfragen und Kommunikation; Feedback (z.B.
                        Sammeln von Feedback via Online-Formular); Marketing.
                    </li>
                    <li><strong class="fw-bold">Rechtsgrundlagen:</strong> Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f) DSGVO).
                    </li>
                </ul>
                <p class="lead"><strong class="fw-bold">Weitere Hinweise zu Verarbeitungsprozessen, Verfahren und Diensten:</strong></p>
                <ul class="m-elements">
                    <li><strong class="fw-bold">Instagram: </strong>Soziales Netzwerk; <strong class="fw-bold">Dienstanbieter:</strong> Meta Platforms
                        Irland Limited, 4 Grand Canal Square, Grand Canal Harbour, Dublin 2, Irland; <strong class="fw-bold">Rechtsgrundlagen:</strong>
                        Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f) DSGVO); <strong class="fw-bold">Website:</strong>
                        <a href="https://www.instagram.com" target="_blank">https://www.instagram.com</a>; <strong class="fw-bold">Datenschutzerklärung:</strong>
                        <a href="https://instagram.com/about/legal/privacy" target="_blank">https://instagram.com/about/legal/privacy</a>.
                    </li>
                    <li><strong class="fw-bold">Facebook-Seiten: </strong>Profile innerhalb des sozialen Netzwerks Facebook - Wir sind
                        gemeinsam mit Meta Platforms Ireland Limited für die Erhebung (jedoch nicht die weitere
                        Verarbeitung) von Daten der Besucher unserer Facebook-Seite (sog. "Fanpage") verantwortlich. Zu
                        diesen Daten gehören Informationen zu den Arten von Inhalten, die Nutzer sich ansehen oder mit
                        denen sie interagieren, oder die von ihnen vorgenommenen Handlungen (siehe unter „Von dir und
                        anderen getätigte und bereitgestellte Dinge“ in der Facebook-Datenrichtlinie:
                        <a href="https://www.facebook.com/policy" target="_blank">https://www.facebook.com/policy</a>),
                        sowie Informationen über die von den Nutzern genutzten Geräte (z. B. IP-Adressen,
                        Betriebssystem, Browsertyp, Spracheinstellungen, Cookie-Daten; siehe unter „Geräteinformationen“
                        in der Facebook-Datenrichtlinie: <a href="https://www.facebook.com/policy" target="_blank">https://www.facebook.com/policy</a>).
                        Wie in der Facebook-Datenrichtlinie unter „Wie verwenden wir diese Informationen?“ erläutert,
                        erhebt und verwendet Facebook Informationen auch, um Analysedienste, so genannte
                        "Seiten-Insights", für Seitenbetreiber bereitzustellen, damit diese Erkenntnisse darüber
                        erhalten, wie Personen mit ihren Seiten und mit den mit ihnen verbundenen Inhalten interagieren.
                        Wir haben mit Facebook eine spezielle Vereinbarung abgeschlossen ("Informationen zu
                        Seiten-Insights",
                        <a href="https://www.facebook.com/legal/terms/page_controller_addendum" target="_blank">https://www.facebook.com/legal/terms/page_controller_addendum</a>),
                        in der insbesondere geregelt wird, welche Sicherheitsmaßnahmen Facebook beachten muss und in der
                        Facebook sich bereit erklärt hat die Betroffenenrechte zu erfüllen (d. h. Nutzer können z. B.
                        Auskünfte oder Löschungsanfragen direkt an Facebook richten). Die Rechte der Nutzer
                        (insbesondere auf Auskunft, Löschung, Widerspruch und Beschwerde bei zuständiger
                        Aufsichtsbehörde), werden durch die Vereinbarungen mit Facebook nicht eingeschränkt. Weitere
                        Hinweise finden sich in den "Informationen zu Seiten-Insights"
                        (<a href="https://www.facebook.com/legal/terms/information_about_page_insights_data" target="_blank">https://www.facebook.com/legal/terms/information_about_page_insights_data</a>);
                        <strong class="fw-bold">Dienstanbieter:</strong> Meta Platforms Ireland Limited, 4 Grand Canal Square, Grand
                        Canal Harbour, Dublin 2, Irland; <strong class="fw-bold">Rechtsgrundlagen:</strong> Berechtigte Interessen (Art.
                        6 Abs. 1 S. 1 lit. f) DSGVO); <strong class="fw-bold">Website:</strong>
                        <a href="https://www.facebook.com" target="_blank">https://www.facebook.com</a>; <strong class="fw-bold">Datenschutzerklärung:</strong>
                        <a href="https://www.facebook.com/about/privacy" target="_blank">https://www.facebook.com/about/privacy</a>;
                        <strong class="fw-bold">Standardvertragsklauseln (Gewährleistung Datenschutzniveau bei Verarbeitung in
                            Drittländern):</strong>
                        <a href="https://www.facebook.com/legal/EU_data_transfer_addendum" target="_blank">https://www.facebook.com/legal/EU_data_transfer_addendum</a>;
                        <strong class="fw-bold">Weitere Informationen:</strong> Vereinbarung gemeinsamer Verantwortlichkeit:
                        <a href="https://www.facebook.com/legal/terms/information_about_page_insights_data" target="_blank">https://www.facebook.com/legal/terms/information_about_page_insights_data</a>.
                        Die gemeinsame Verantwortlichkeit beschränkt sich auf die Erhebung durch und Übermittlung von
                        Daten an Meta Platforms Ireland Limited, ein Unternehmen mit Sitz in der EU. Die weitere
                        Verarbeitung der Daten liegt in der alleinigen Verantwortung von Meta Platforms Ireland Limited,
                        was insbesondere die Übermittlung der Daten an die Muttergesellschaft Meta Platforms, Inc. in
                        den USA betrifft (auf der Grundlage der zwischen Meta Platforms Ireland Limited und Meta
                        Platforms, Inc. geschlossenen Standardvertragsklauseln).
                    </li>
                </ul>
                <h2 id="m328">Plugins und eingebettete Funktionen sowie Inhalte</h2>
                <p class="lead">Wir binden in unser Onlineangebot Funktions- und Inhaltselemente ein, die von den Servern ihrer
                    jeweiligen Anbieter (nachfolgend bezeichnet als "Drittanbieter”) bezogen werden. Dabei kann es sich
                    zum Beispiel um Grafiken, Videos oder Stadtpläne handeln (nachfolgend einheitlich bezeichnet als
                    "Inhalte”).</p>
                <p class="lead">Die Einbindung setzt immer voraus, dass die Drittanbieter dieser Inhalte die IP-Adresse der Nutzer
                    verarbeiten, da sie ohne die IP-Adresse die Inhalte nicht an deren Browser senden könnten. Die
                    IP-Adresse ist damit für die Darstellung dieser Inhalte oder Funktionen erforderlich. Wir bemühen
                    uns, nur solche Inhalte zu verwenden, deren jeweilige Anbieter die IP-Adresse lediglich zur
                    Auslieferung der Inhalte verwenden. Drittanbieter können ferner sogenannte Pixel-Tags (unsichtbare
                    Grafiken, auch als "Web Beacons" bezeichnet) für statistische oder Marketingzwecke verwenden. Durch
                    die "Pixel-Tags" können Informationen, wie der Besucherverkehr auf den Seiten dieser Webseite,
                    ausgewertet werden. Die pseudonymen Informationen können ferner in Cookies auf dem Gerät der Nutzer
                    gespeichert werden und unter anderem technische Informationen zum Browser und zum Betriebssystem, zu
                    verweisenden Webseiten, zur Besuchszeit sowie weitere Angaben zur Nutzung unseres Onlineangebotes
                    enthalten als auch mit solchen Informationen aus anderen Quellen verbunden werden.</p>
                <ul class="m-elements">
                    <li><strong class="fw-bold">Verarbeitete Datenarten:</strong> Nutzungsdaten (z.B. besuchte Webseiten, Interesse an
                        Inhalten, Zugriffszeiten); Meta-/Kommunikationsdaten (z.B. Geräte-Informationen, IP-Adressen);
                        Bestandsdaten (z.B. Namen, Adressen); Kontaktdaten (z.B. E-Mail, Telefonnummern); Inhaltsdaten
                        (z.B. Eingaben in Onlineformularen); Standortdaten (Angaben zur geografischen Position eines
                        Gerätes oder einer Person).
                    </li>
                    <li><strong class="fw-bold">Betroffene Personen:</strong> Nutzer (z.B. Webseitenbesucher, Nutzer von
                        Onlinediensten).
                    </li>
                    <li><strong class="fw-bold">Zwecke der Verarbeitung:</strong> Bereitstellung unseres Onlineangebotes und
                        Nutzerfreundlichkeit.
                    </li>
                    <li><strong class="fw-bold">Rechtsgrundlagen:</strong> Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f) DSGVO).
                    </li>
                </ul>
                <p class="lead"><strong class="fw-bold">Weitere Hinweise zu Verarbeitungsprozessen, Verfahren und Diensten:</strong></p>
                <ul class="m-elements">
                    <li><strong class="fw-bold">Einbindung von Drittsoftware, Skripten oder Frameworks (z. B. jQuery): </strong>Wir
                        binden in unser Onlineangebot Software ein, die wir von Servern anderer Anbieter abrufen (z.B.
                        Funktions-Bibliotheken, die wir zwecks Darstellung oder Nutzerfreundlichkeit unseres
                        Onlineangebotes verwenden). Hierbei erheben die jeweiligen Anbieter die IP-Adresse der Nutzer
                        und können diese zu Zwecken der Übermittlung der Software an den Browser der Nutzer sowie zu
                        Zwecken der Sicherheit, als auch zur Auswertung und Optimierung ihres Angebotes verarbeiten. -
                        Wir binden in unser Onlineangebot Software ein, die wir von Servern anderer Anbieter abrufen
                        (z.B. Funktions-Bibliotheken, die wir zwecks Darstellung oder Nutzerfreundlichkeit unseres
                        Onlineangebotes verwenden). Hierbei erheben die jeweiligen Anbieter die IP-Adresse der Nutzer
                        und können diese zu Zwecken der Übermittlung der Software an den Browser der Nutzer sowie zu
                        Zwecken der Sicherheit, als auch zur Auswertung und Optimierung ihres Angebotes verarbeiten;
                        <strong class="fw-bold">Rechtsgrundlagen:</strong> Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f) DSGVO).
                    </li>
                    <li><strong class="fw-bold">Google Fonts (Bereitstellung auf eigenem Server): </strong>Schriftarten ("Google Fonts")
                        zwecks einer nutzerfreundlichen Darstellung unseres Onlineangebotes;
                        <strong class="fw-bold">Dienstanbieter:</strong> Die Google Fonts werden auf unserem Server gehostet, es werden
                        keine Daten an Google übermittelt; <strong class="fw-bold">Rechtsgrundlagen:</strong> Berechtigte Interessen
                        (Art. 6 Abs. 1 S. 1 lit. f) DSGVO).
                    </li>
                    <li><strong class="fw-bold">Google Fonts (Bezug vom Google Server): </strong>Bezug von Schriften (und Symbolen) zum
                        Zwecke einer technisch sicheren, wartungsfreien und effizienten Nutzung von Schriften und
                        Symbolen im Hinblick auf Aktualität und Ladezeiten, deren einheitliche Darstellung und
                        Berücksichtigung möglicher lizenzrechtlicher Beschränkungen. Dem Anbieter der Schriftarten wird
                        die IP-Adresse des Nutzers mitgeteilt, damit die Schriftarten im Browser des Nutzers zur
                        Verfügung gestellt werden können. Darüber hinaus werden technische Daten (Spracheinstellungen,
                        Bildschirmauflösung, Betriebssystem, verwendete Hardware) übermittelt, die für die
                        Bereitstellung der Schriften in Abhängigkeit von den verwendeten Geräten und der technischen
                        Umgebung notwendig sind. Diese Daten können auf einem Server des Anbieters der Schriftarten in
                        den USA verarbeitet werden; <strong class="fw-bold">Dienstanbieter:</strong> Google Ireland Limited, Gordon
                        House, Barrow Street, Dublin 4, Irland; <strong class="fw-bold">Rechtsgrundlagen:</strong> Berechtigte
                        Interessen (Art. 6 Abs. 1 S. 1 lit. f) DSGVO); <strong class="fw-bold">Website:</strong>
                        <a href="https://fonts.google.com/" target="_blank">https://fonts.google.com/</a>; <strong class="fw-bold">Datenschutzerklärung:</strong>
                        <a href="https://policies.google.com/privacy" target="_blank">https://policies.google.com/privacy</a>.
                    </li>
                    <li><strong class="fw-bold">Font Awesome (Bereitstellung auf eigenem Server): </strong>Darstellung von Schriftarten
                        und Symbolen; <strong class="fw-bold">Dienstanbieter:</strong> Die Font Awesome Icons werden auf unserem Server
                        gehostet, es werden keine Daten an den Anbieter von Font Awesome übermittelt; <strong class="fw-bold">Rechtsgrundlagen:</strong>
                        Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f) DSGVO).
                    </li>
                    <li><strong class="fw-bold">Google Maps: </strong>Wir binden die Landkarten des Dienstes “Google Maps” des Anbieters
                        Google ein. Zu den verarbeiteten Daten können insbesondere IP-Adressen und Standortdaten der
                        Nutzer gehören; <strong class="fw-bold">Dienstanbieter:</strong> Google Cloud EMEA Limited, 70 Sir John
                        Rogerson’s Quay, Dublin 2, Irland; <strong class="fw-bold">Rechtsgrundlagen:</strong> Berechtigte Interessen
                        (Art. 6 Abs. 1 S. 1 lit. f) DSGVO); <strong class="fw-bold">Website:</strong>
                        <a href="https://mapsplatform.google.com/" target="_blank">https://mapsplatform.google.com/</a>;
                        <strong class="fw-bold">Datenschutzerklärung:</strong>
                        <a href="https://policies.google.com/privacy" target="_blank">https://policies.google.com/privacy</a>.
                    </li>
                    <li><strong class="fw-bold">YouTube-Videos: </strong>Videoinhalte; <strong class="fw-bold">Dienstanbieter:</strong> Google Ireland
                        Limited, Gordon House, Barrow Street, Dublin 4, Irland; <strong class="fw-bold">Rechtsgrundlagen:</strong>
                        Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f) DSGVO); <strong class="fw-bold">Website:</strong>
                        <a href="https://www.youtube.com" target="_blank">https://www.youtube.com</a>; <strong class="fw-bold">Datenschutzerklärung:</strong>
                        <a href="https://policies.google.com/privacy" target="_blank">https://policies.google.com/privacy</a>;
                        <strong class="fw-bold">Widerspruchsmöglichkeit (Opt-Out):</strong> Opt-Out-Plugin:
                        <a href="https://tools.google.com/dlpage/gaoptout?hl=de" target="_blank">https://tools.google.com/dlpage/gaoptout?hl=de</a>,
                        Einstellungen für die Darstellung von Werbeeinblendungen:
                        <a href="https://adssettings.google.com/authenticated" target="_blank">https://adssettings.google.com/authenticated</a>.
                    </li>
                </ul>
                <h2 id="m15">Änderung und Aktualisierung der Datenschutzerklärung</h2>
                <p class="lead">Wir bitten Sie, sich regelmäßig über den Inhalt unserer Datenschutzerklärung zu informieren. Wir
                    passen die Datenschutzerklärung an, sobald die Änderungen der von uns durchgeführten
                    Datenverarbeitungen dies erforderlich machen. Wir informieren Sie, sobald durch die Änderungen eine
                    Mitwirkungshandlung Ihrerseits (z.B. Einwilligung) oder eine sonstige individuelle Benachrichtigung
                    erforderlich wird.</p>
                <p class="lead">Sofern wir in dieser Datenschutzerklärung Adressen und Kontaktinformationen von Unternehmen und
                    Organisationen angeben, bitten wir zu beachten, dass die Adressen sich über die Zeit ändern können
                    und bitten die Angaben vor Kontaktaufnahme zu prüfen.</p>
                <h2 id="m10">Rechte der betroffenen Personen</h2>
                <p class="lead">Ihnen stehen als Betroffene nach der DSGVO verschiedene Rechte zu, die sich insbesondere aus Art. 15
                    bis 21 DSGVO ergeben:</p>
                <ul>
                    <li><strong class="fw-bold">Widerspruchsrecht: Sie haben das Recht, aus Gründen, die sich aus Ihrer besonderen
                            Situation ergeben, jederzeit gegen die Verarbeitung der Sie betreffenden personenbezogenen
                            Daten, die aufgrund von Art. 6 Abs. 1 lit. e oder f DSGVO erfolgt, Widerspruch einzulegen;
                            dies gilt auch für ein auf diese Bestimmungen gestütztes Profiling. Werden die Sie
                            betreffenden personenbezogenen Daten verarbeitet, um Direktwerbung zu betreiben, haben Sie
                            das Recht, jederzeit Widerspruch gegen die Verarbeitung der Sie betreffenden
                            personenbezogenen Daten zum Zwecke derartiger Werbung einzulegen; dies gilt auch für das
                            Profiling, soweit es mit solcher Direktwerbung in Verbindung steht.</strong></li>
                    <li><strong class="fw-bold">Widerrufsrecht bei Einwilligungen:</strong> Sie haben das Recht, erteilte Einwilligungen
                        jederzeit zu widerrufen.
                    </li>
                    <li><strong class="fw-bold">Auskunftsrecht:</strong> Sie haben das Recht, eine Bestätigung darüber zu verlangen, ob
                        betreffende Daten verarbeitet werden und auf Auskunft über diese Daten sowie auf weitere
                        Informationen und Kopie der Daten entsprechend den gesetzlichen Vorgaben.
                    </li>
                    <li><strong class="fw-bold">Recht auf Berichtigung:</strong> Sie haben entsprechend den gesetzlichen Vorgaben das
                        Recht, die Vervollständigung der Sie betreffenden Daten oder die Berichtigung der Sie
                        betreffenden unrichtigen Daten zu verlangen.
                    </li>
                    <li><strong class="fw-bold">Recht auf Löschung und Einschränkung der Verarbeitung:</strong> Sie haben nach Maßgabe
                        der gesetzlichen Vorgaben das Recht, zu verlangen, dass Sie betreffende Daten unverzüglich
                        gelöscht werden, bzw. alternativ nach Maßgabe der gesetzlichen Vorgaben eine Einschränkung der
                        Verarbeitung der Daten zu verlangen.
                    </li>
                    <li><strong class="fw-bold">Recht auf Datenübertragbarkeit:</strong> Sie haben das Recht, Sie betreffende Daten, die
                        Sie uns bereitgestellt haben, nach Maßgabe der gesetzlichen Vorgaben in einem strukturierten,
                        gängigen und maschinenlesbaren Format zu erhalten oder deren Übermittlung an einen anderen
                        Verantwortlichen zu fordern.
                    </li>
                    <li><strong class="fw-bold">Beschwerde bei Aufsichtsbehörde:</strong> Sie haben unbeschadet eines anderweitigen
                        verwaltungsrechtlichen oder gerichtlichen Rechtsbehelfs das Recht auf Beschwerde bei einer
                        Aufsichtsbehörde, insbesondere in dem Mitgliedstaat ihres gewöhnlichen Aufenthaltsorts, ihres
                        Arbeitsplatzes oder des Orts des mutmaßlichen Verstoßes, wenn Sie der Ansicht sind, dass die
                        Verarbeitung der Sie betreffenden personenbezogenen Daten gegen die Vorgaben der DSGVO verstößt.
                    </li>
                </ul>
                Für uns zuständige Aufsichtsbehörde: <p class="lead">Thüringer Landesbeauftragter für den Datenschutz und die
                    Informationsfreiheit<br><br>Dr. Lutz Hasse<br>Postfach 90 04 55<br>99107 Erfurt<br><br>Häßlerstraße
                    8<br>99096 Erfurt<br><br>Telefon: 03 61/57 311 29 00<br>E-Mail:
                    <a href="mailto:poststelle@datenschutz.thueri">poststelle@datenschutz.thueri</a>ngen.de<br>Homepage:
                    <a href="https://www.tlfdi.de" target="_blank">https://www.tlfdi.de</a></p>
                <h2 id="m42">Begriffsdefinitionen</h2>
                <p class="lead">In diesem Abschnitt erhalten Sie eine Übersicht über die in dieser Datenschutzerklärung verwendeten
                    Begrifflichkeiten. Viele der Begriffe sind dem Gesetz entnommen und vor allem im Art. 4 DSGVO
                    definiert. Die gesetzlichen Definitionen sind verbindlich. Die nachfolgenden Erläuterungen sollen
                    dagegen vor allem dem Verständnis dienen. Die Begriffe sind alphabetisch sortiert.</p>
                <ul class="glossary">
                    <li><strong class="fw-bold">Personenbezogene Daten:</strong> "Personenbezogene Daten“ sind alle Informationen, die
                        sich auf eine identifizierte oder identifizierbare natürliche Person (im Folgenden "betroffene
                        Person“) beziehen; als identifizierbar wird eine natürliche Person angesehen, die direkt oder
                        indirekt, insbesondere mittels Zuordnung zu einer Kennung wie einem Namen, zu einer Kennnummer,
                        zu Standortdaten, zu einer Online-Kennung (z.B. Cookie) oder zu einem oder mehreren besonderen
                        Merkmalen identifiziert werden kann, die Ausdruck der physischen, physiologischen, genetischen,
                        psychischen, wirtschaftlichen, kulturellen oder sozialen Identität dieser natürlichen Person
                        sind.
                    </li>
                    <li><strong class="fw-bold">Profile mit nutzerbezogenen Informationen:</strong> Die Verarbeitung von "Profilen mit
                        nutzerbezogenen Informationen", bzw. kurz "Profilen" umfasst jede Art der automatisierten
                        Verarbeitung personenbezogener Daten, die darin besteht, dass diese personenbezogenen Daten
                        verwendet werden, um bestimmte persönliche Aspekte, die sich auf eine natürliche Person beziehen
                        (je nach Art der Profilbildung können dazu unterschiedliche Informationen betreffend die
                        Demographie, Verhalten und Interessen, wie z.B. die Interaktion mit Webseiten und deren
                        Inhalten, etc.) zu analysieren, zu bewerten oder, um sie vorherzusagen (z.B. die Interessen an
                        bestimmten Inhalten oder Produkten, das Klickverhalten auf einer Webseite oder den
                        Aufenthaltsort). Zu Zwecken des Profilings werden häufig Cookies und Web-Beacons eingesetzt.
                    </li>
                    <li><strong class="fw-bold">Reichweitenmessung:</strong> Die Reichweitenmessung (auch als Web Analytics bezeichnet)
                        dient der Auswertung der Besucherströme eines Onlineangebotes und kann das Verhalten oder
                        Interessen der Besucher an bestimmten Informationen, wie z.B. Inhalten von Webseiten, umfassen.
                        Mit Hilfe der Reichweitenanalyse können Webseiteninhaber z.B. erkennen, zu welcher Zeit Besucher
                        ihre Webseite besuchen und für welche Inhalte sie sich interessieren. Dadurch können sie z.B.
                        die Inhalte der Webseite besser an die Bedürfnisse ihrer Besucher anpassen. Zu Zwecken der
                        Reichweitenanalyse werden häufig pseudonyme Cookies und Web-Beacons eingesetzt, um
                        wiederkehrende Besucher zu erkennen und so genauere Analysen zur Nutzung eines Onlineangebotes
                        zu erhalten.
                    </li>
                    <li><strong class="fw-bold">Standortdaten:</strong> Standortdaten entstehen, wenn sich ein mobiles Gerät (oder ein
                        anderes Gerät mit den technischen Voraussetzungen einer Standortbestimmung) mit einer Funkzelle,
                        einem WLAN oder ähnlichen technischen Mittlern und Funktionen der Standortbestimmung, verbindet.
                        Standortdaten dienen der Angabe, an welcher geografisch bestimmbaren Position der Erde sich das
                        jeweilige Gerät befindet. Standortdaten können z. B. eingesetzt werden, um Kartenfunktionen oder
                        andere von einem Ort abhängige Informationen darzustellen.
                    </li>
                    <li><strong class="fw-bold">Tracking:</strong> Vom "Tracking“ spricht man, wenn das Verhalten von Nutzern über
                        mehrere Onlineangebote hinweg nachvollzogen werden kann. Im Regelfall werden im Hinblick auf die
                        genutzten Onlineangebote Verhaltens- und Interessensinformationen in Cookies oder auf Servern
                        der Anbieter der Trackingtechnologien gespeichert (sogenanntes Profiling). Diese Informationen
                        können anschließend z.B. eingesetzt werden, um den Nutzern Werbeanzeigen anzuzeigen, die
                        voraussichtlich deren Interessen entsprechen.
                    </li>
                    <li><strong class="fw-bold">Verantwortlicher:</strong> Als "Verantwortlicher“ wird die natürliche oder juristische
                        Person, Behörde, Einrichtung oder andere Stelle, die allein oder gemeinsam mit anderen über die
                        Zwecke und Mittel der Verarbeitung von personenbezogenen Daten entscheidet, bezeichnet.
                    </li>
                    <li><strong class="fw-bold">Verarbeitung:</strong> "Verarbeitung" ist jeder mit oder ohne Hilfe automatisierter
                        Verfahren ausgeführte Vorgang oder jede solche Vorgangsreihe im Zusammenhang mit
                        personenbezogenen Daten. Der Begriff reicht weit und umfasst praktisch jeden Umgang mit Daten,
                        sei es das Erheben, das Auswerten, das Speichern, das Übermitteln oder das Löschen.
                    </li>
                </ul>
                <p class="seal">
                    <a href="https://datenschutz-generator.de/" title="Rechtstext von Dr. Schwenke - für weitere Informationen bitte anklicken." target="_blank" rel="noopener noreferrer nofollow">Erstellt
                        mit kostenlosem Datenschutz-Generator.de von Dr. Thomas Schwenke</a></p>
            </div>
        </div>

    </section>
@endsection
