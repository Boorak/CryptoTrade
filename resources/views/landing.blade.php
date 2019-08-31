@extends('layouts.app-base')

@section('body')

    <div class="section section-about-us">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <h2 class="title">چرا پودونک؟</h2>
                    <h5 class="description">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از
                        طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای
                        شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای
                        زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم
                        افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان
                        فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط
                        سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل
                        دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="section section-team text-center">
        <div class="container">
            <h2 class="title">مزایای پودونک</h2>
            <div class="team">
                <div class="row">
                    <div class="col-md-3">
                        <div class="team-player">
                            <img src="{{asset('images/landing/security.svg')}}" alt="Thumbnail Image"
                                 class="rounded-circle img-fluid">
                            <h4 class="title">امنیت</h4>
                            <p class="description">
                                امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان
                                مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی
                                اساسا مورد استفاده قرار گیرد.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="team-player">
                            <img src="{{asset('images/landing/exchange.svg')}}" alt="Thumbnail Image"
                                 class="rounded-circle img-fluid">
                            <h4 class="title">پرداخت سریع</h4>
                            <p class="description">امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ
                                به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل
                                دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="team-player">
                            <img src="{{asset('images/landing/margin.svg')}}" alt="Thumbnail Image"
                                 class="rounded-circle img-fluid">
                            <h4 class="title">سفارش سریع</h4>
                            <p class="description">امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ
                                به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل
                                دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="team-player">
                            <img src="{{asset('images/landing/margin.svg')}}" alt="Thumbnail Image"
                                 class="rounded-circle img-fluid">
                            <h4 class="title">سفارش سریع</h4>
                            <p class="description">امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ
                                به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل
                                دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection