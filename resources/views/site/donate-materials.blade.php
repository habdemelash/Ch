@extends('layouts.site')
@section('content')
    <section id="contact" class="contact mt-5">
        <div class="container">
            <div class="section-title">
                <span>Materials Donation</span>
                <h2>Help our effort with just what you have</h2>
                <p>We will find and contact you as soon as possible</p>
            </div>
            <div class="row">
                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p>Bole, Adama, Ethiopia</p>
                        </div>
                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p>info@cvsms.com</p>
                        </div>
                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Call:</h4>
                            <p>+251920763031</p>
                        </div>
                        <div class="container-fluid">
                            ያለብዎትን ችግር እዚህ ፎርም ውስጥ ይሙሉና ይላኩልን። እኛም እርስዎን ለመርዳትና ረጂዎችን ለማፈላለግ እንሞክራለን።
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name"><i class="bx bxs-user mx-1 text-danger"></i>First name</label>
                                <input type="text" name="name" class="form-control" id="name" required
                                    placeholder="First name*">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last-name"><i class="bx bxs-user mx-1 text-danger"></i>Last name</label>
                                <input type="text" name="name" class="form-control" id="name" required
                                    placeholder="Last name*">
                            </div>
                            <div class="form-group col-md-6 mt-3 mt-md-0">
                                <label for="name"><i class="bx bxs-envelope mx-1 text-danger"></i>Your email</label>
                                <input type="email" class="form-control" name="email" id="email" required
                                    placeholder="Email*">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone"><i class="bx bxs-phone mx-1 text-danger"></i>Phone</label>
                                <input type="tel" class="form-control" name="phone" id="phone" required
                                    placeholder="Phone number*">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group mt-3">
                            <label for="address"><i class="bx bxs-map mx-1 text-danger"></i>Your address</label>
                            <p><small class="text-primary">Write your town/city here and block..</small></p>
                            <input type="text" class="form-control" name="address" id="address" required
                                placeholder="Address*">
                        </div>
                        <div class="form-group mt-3">
                            <label for="name"><i class="bx bx-list-plus mx-1 text-danger"></i>List of materials</label>
                            <p><small class="text-primary">Write all materials you want to donate including their
                                    conditions.</small></p>
                            <textarea class="form-control" name="materials" rows="6" required placeholder="Materials*"></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
