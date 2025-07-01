@extends('layouts.frontend')

@section('content')
<main class="main_wrapper body__overlay overflow__hidden">

      <!-- breadcrumb__start -->
      <div class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb__title">
                        <h1>Login</h1>
                        <ul>
                            <li>
                                <a href="#">Home</a>
                            </li>
                            <li class="color__blue">
                                Login
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- breadcrumb__end -->


 <!-- login__section__start -->
    <div class="loginarea  sp_bottom_80 sp_top_80">
     <div class="container">
        <div class="row">
            <div class="col-xl-8 offset-md-2 loginarea__col">
                <ul class="nav  tab__button__wrap text-center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="single__tab__link active" data-bs-toggle="tab" data-bs-target="#projects__one" type="button">Login</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="single__tab__link" data-bs-toggle="tab" data-bs-target="#projects__two" type="button">Sing up</button>
                    </li>



                </ul>
            </div>


            <div class="tab-content tab__content__wrapper" id="myTabContent">

                <div class="tab-pane fade active show" id="projects__one" role="tabpanel" aria-labelledby="projects__one">
                    <div class="col-xl-8 offset-md-2 loginarea__col">
                        <div class="loginarea__wraper">
                            <div class="loginarea__heading">
                                <h5 class="login__title">Login</h5>
                                <p class="login__description">Don't have an account yet? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Sign up for free</a></p>
                            </div>



                            <form method="post" action="{{ route('login')}}">
                                @csrf
                                <div class="loginarea__form">
                                    <label class="form__label">Email</label>
                                    <input class="common__login__input" type="text" name="email" type="email" placeholder="Your Email">

                                </div>
                                <div class="loginarea__form">
                                    <label class="form__label">Password</label>
                                    <input class="common__login__input" type="password" name="password" type="password" placeholder="Password">

                                </div>
                                <div class="loginarea__form d-flex justify-content-between flex-wrap gap-2">
                                    <div class="form__check">
                                        <input type="checkbox" id="login__privacy">
                                        <label for="login__privacy">Remember Me</label>
                                    </div>
                                    <div class="text-end login__form__link">
                                        <a href="{{route('password.request')}}">Forgot your password?</a>
                                    </div>
                                </div>
                                <div class="loginarea__button text-center">
                                    <button class="default__button" type="submit" href="#">Log In</button>
                                </div>
                            </form>

                            <div class="loginarea__social__option">
                              
                                <ul class="loginarea__social__btn">
                                    <li><a class="default__button" href="#"><i class="fab fa-facebook-f"></i> facebook</a></li>
                                    <li><a class="default__button" href="#"><i class="fab fa-google"></i> Google</a></li>
                                </ul>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="projects__two" role="tabpanel" aria-labelledby="projects__two">
                    <div class="col-xl-8 offset-md-2 loginarea__col">
                        <div class="loginarea__wraper">
                            <div class="loginarea__heading">
                                <h5 class="login__title">Sing Up</h5>
                                <p class="login__description">Already have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Log In</a></p>
                            </div>



                            <form action="#">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="loginarea__form">
                                            <label class="form__label">Name</label>
                                            <input class="common__login__input" name="name" type="text" placeholder="Your Name">

                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="loginarea__form">
                                            <label class="form__label">Email</label>
                                            <input class="common__login__input" name="email" type="email" placeholder="Your Email">

                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="loginarea__form">
                                            <label class="form__label">Password</label>
                                            <input class="common__login__input" name="password" type="password" placeholder="Password">

                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="loginarea__form">
                                            <label class="form__label">Confirm Password</label>
                                            <input class="common__login__input" name="password" type="password" type="password" placeholder="Confirm Password">

                                        </div>
                                    </div>
                                </div>

                                <div class="loginarea__form d-flex justify-content-between flex-wrap gap-2">
                                    <div class="form__check">
                                        <input type="checkbox" id="regi__privacy">
                                        <label for="regi__privacy">Accept the Terms and Privacy Policy</label>
                                    </div>

                                </div>
                                <div class="login__button">
                                    <a class="default__button text-center" href="#">Sign Up</a>
                                </div>
                            </form>




                        </div>
                    </div>

                </div>



            </div>





        </div>

   


    </div>
    </div>


<!-- footer__section__start -->
<div class="footer ">
    <div class="footer__inner sp_top_80">
    <div class="container sp_bottom_60">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="footer__widget">
                    <h4 class="footer__title">About Us.</h4>
                    <div class="footer__content">
                        <p>Minimal E-Commerce is a dynamic and innovative online retail platform that offers a wide range of products to customers worldwide.</p>
                    </div>
                    <div class="footer__social__icon">
                        <ul>
                            <li><a target="_blank" title="Facebook-f" href="https://www.facebook.com/shopify"><i class="fab fa-facebook-f"></i></a></li>     
                            
                            
                            <li><a target="_blank" title="Twitter" href="https://twitter.com/shopify"><i class="fab fa-twitter"></i></a></li>       
                               
                            
                            
                            <li><a target="_blank" title="Youtube" href="https://www.youtube.com/user/shopify"><i class="fab fa-youtube"></i></a></li>       
                            
                            
                            <li><a target="_blank" title="Instagram" href="https://www.instagram.com/shopify/"><i class="fab fa-instagram"></i></a></li>       
                            
                            
                            <li><a target="_blank" title="Tiktok" href="https://www.tiktok.com/@shopify"><i class="fab fa-tiktok"></i></a></li>       
                            
                            
                            </ul>
                    </div>
                    <div class="footer__bottom">
<h5>Guaranteed safe checkout</h5>
                            <div class="footer__img">
                                <ul>
                                    <li>
                                        <img src="img/footer/footer__1.svg" alt="">
                                    </li>
                                    <li>
                                        <img src="img/footer/footer__2.svg" alt="">
                                    </li>
                                    <li>
                                        <img src="img/footer/footer__3.svg" alt="">
                                    </li>
                                    <li>
                                        <img src="img/footer/footer__4.svg" alt="">
                                    </li>
                                    <li>
                                        <img src="img/footer/footer__5.svg" alt="">
                                    </li>
                                    <li>
                                        <img src="img/footer/footer__6.svg" alt="">
                                    </li>
                                </ul>
                            </div>
                </div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-6">
                <div class="footer__widget">
                    <h4 class="footer__title">Quick Link</h4>
                    <div class="footer__menu">
                    <ul>
                        <li><a href="/account">My Account</a></li>
                        <li><a href="/cart">My Cart</a></li>
                        <li><a href="/pages/wishlist">Wishlist</a></li>
                        <li><a href="/">Gift Card</a></li>
                        <li><a href="/pages/contact">Need Help?</a></li>
                    </ul>
                  </div>
                </div>
            </div>


            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-6">
                <div class="footer__widget">
                    <h4 class="footer__title">Information</h4>
                    <div class="footer__menu">
                    <ul>
                        <li><a href="/account">About us</a></li>
                        <li><a href="/cart">Contact</a></li>
                        <li><a href="/pages/wishlist">Blogs</a></li>
                        <li><a href="/">Gift Card</a></li>
                        <li><a href="/pages/contact">Size Chart</a></li>
                    </ul>
                  </div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-6">
                <div class="footer__widget">
                    <h4 class="footer__title">Policies</h4>
                    <div class="footer__menu">
                    <ul>
                        <li><a href="/account">Privacy Policy</a></li>
                        <li><a href="/cart">Refund Policy</a></li>
                        <li><a href="/pages/wishlist">Terms of Service</a></li>
                        <li><a href="/">Gift Card</a></li>
                        <li><a href="/pages/contact">Shipping Policy</a></li>
                    </ul>
                  </div>
                </div>
            </div>



        </div>
    </div>
    </div>

    <div class="copyright">
    <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <div class="copyright__text">
                <p>© 2024 <strong>Minimalin</strong>. All rights reserved.</p>
           
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
 <!-- footer__section__end -->
</main>
@endsection
