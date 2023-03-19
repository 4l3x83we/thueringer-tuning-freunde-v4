<section class="ueber-uns text-bg-dark" id="ueber-uns">
    <div class="container shadow">

        <div class="row py-3">
            <div class="col-lg-4">
                <div class="icon-box shadow">
                    <em class="bi bi-car-front"></em>
                    <h3><span>Marken offener Tuningclub</span></h3>
                    <p class="lead">Keine Markenbindung, alle Fahrzeugtypen sind willkommen bei uns. Auch du musst nicht der Jugendliche sein, Tuning macht auch im Alter Spaß.</p>
                </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="icon-box shadow">
                    <em class="bi bi-wrench-adjustable"></em>
                    <h3><span>Werkstatt</span></h3>
                    <p class="lead">Kleine Werkstatt mit ca. 245 m² steht euch jederzeit zur Verfügung. Hier befindet sich auch unser Club.</p>
                </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="icon-box shadow">
                    <em class="bi bi-people-fill"></em>
                    <h3><span>Was erwartet Dich?</span></h3>
                    <p class="lead">Ein lustiges Team, das gerne schraubt, grillt und sich mit anderen Clubs trifft. Wir treffen uns 1-mal im Monat, ansonsten zu jedem Treffen, das wir besuchen.</p>
                </div>
            </div>
        </div>

        <div class="row py-2">

            <div class="col-lg-6">
                <img src="{{ Vite::image('logo.svg') }}" class="img-fluid rounded shadow ueber-uns__images lozad" alt="Über uns" type="image/svg+xml" style="fill: #a3a3a3;">
            </div>

            <div class="col-lg-6 pt-4 pt-lg-0 content">
                <h3>Hallo liebe Interessenten!</h3>
                <p class="fst-italic">
                    Wir sind eine kleine Gruppe von Schraubern und Autobegeisterten, die sich schon länger kennen, aber sich erst im Juli 2017 entschlossen haben, zusammen einen Club zu gründen.
                </p>
                <ul>
                    <li><em class="bi bi-check-circle"></em> Eigene Werkstatt mit diversem Spezialwerkzeug.</li>
                    <li><em class="bi bi-check-circle"></em> Bei uns gibt es keine Markenbindung oder Markenhass.</li>
                    <li><em class="bi bi-check-circle"></em> Du schraubst gern an Autos, gehörst keinen Club an, und willst das ändern, dann bist Du hier genau richtig.</li>
                </ul>
                <p class="lead">
                    Marken offener Tuningclub egal ob Audi, Alfa, Volkswagen, BMW, Ford, Opel oder Trabant, jeder der sein Fahrzeug liebt und gern schraubt und dabei noch Spaß daran hat, darf sich melden bei uns.
                </p>
            </div>

            <div class="counts pt-3" id="counts">
                <div class="row">

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-right" data-aos-delay="100">
                        <div class="count-box shadow">
                            <em class="bi bi-people-fill"></em>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $count['team'] }}" data-purecounter-duration="1" class="purecounter">0</span>
                            <p><strong>Mitglieder</strong> sind aktuell in unserem Club</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-3 mt-lg-0 d-md-flex align-items-md-stretch" data-aos="fade-down-right" data-aos-delay="200">
                        <div class="count-box shadow">
                            <em class="bi bi-car-front"></em>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $count['fahrzeuge']  }}" data-purecounter-duration="1" class="purecounter">0</span>
                            <p><strong>Fahrzeuge</strong> haben wir aktuell in unserem Club</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-3 mt-lg-0 d-md-flex align-items-md-stretch" data-aos="fade-down-left" data-aos-delay="300">
                        <div class="count-box shadow">
                            <em class="bi bi-calendar-week"></em>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $count['treffen']  }}" data-purecounter-duration="1" class="purecounter">0</span>
                            <p><strong>Treffen</strong> die wir Besuchen werden</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-3 mt-lg-0 d-md-flex align-items-md-stretch" data-aos="fade-left" data-aos-delay="400">
                        <div class="count-box shadow">
                            <em class="bi bi-cone-striped"></em>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $count['projekte']  }}" data-purecounter-duration="1" class="purecounter">0</span>
                            <p><strong>Projekte</strong> unserer Mitglieder</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
