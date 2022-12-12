        <!-- Modal -->
        <div class="modal fade" id="guestbookWrite" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="guestbookWriteLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form action="{{ route('frontend.gaestebuch.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="guestbookWriteLabel"><em class="bi bi-vector-pen"></em> In das Gästebuch schreiben.</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" placeholder="Name" id="name" value="{{ old('name') }}">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="email">E-Mail Adresse:</label>
                                    <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" placeholder="E-Mail Adresse" id="email" value="{{ old('email') }}">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="website">Webseite:</label>
                                    <input type="text" class="form-control form-control-sm @error('website') is-invalid @enderror" name="website" placeholder="Webseite" id="website" value="{{ old('website') }}">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="facebook"><em class="bi bi-facebook"></em> Facebook:</label>
                                    <input type="text" class="form-control form-control-sm @error('facebook') is-invalid @enderror" name="facebook" placeholder="Facebook" id="facebook" value="{{ old('facebook') }}">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="tiktok"><em class="bi bi-tiktok"></em> TikTok:</label>
                                    <input type="text" class="form-control form-control-sm @error('tiktok') is-invalid @enderror" name="tiktok" placeholder="TikTok" id="tiktok" value="{{ old('tiktok') }}">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="instagram"><em class="bi bi-instagram"></em> Instagram:</label>
                                    <input type="text" class="form-control form-control-sm @error('instagram') is-invalid @enderror" name="instagram" placeholder="Instagram" id="instagram" value="{{ old('instagram') }}">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="message">Nachricht:</label>
                                    <textarea placeholder="Hier kannst du uns einen Gästebucheintrag hinterlassen!" class="form-control form-control-sm @error('message') is-invalid @enderror" name="message" placeholder="Nachricht" id="message">{!! old('message') !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm fw-bold" data-bs-dismiss="modal">Schließen</button>
                            <button type="submit" class="btn btn-primary btn-sm fw-bold">Speichern</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
