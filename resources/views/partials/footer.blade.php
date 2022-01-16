<hr style="color: #8edfce; margin-top: 50px; margin-bottom: 0px; width: 70%">
<div class="footer-clean">
    <footer>
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-sm-4 col-md-3 item">
                    <h3>Мобильные приложения</h3>
                    <img src="http://cinema.com/storage/img/googleplay.png" style="width: 100px"/>
                    <img src="http://cinema.com/storage/img/appstore.png" style="width: 100px"/>
                    <p class="copyright">Разработка сайтов: AVADA-MEDIA</p>
                </div>
                <div class="col-sm-4 col-md-3 item">
                    <a style="color: #4b4c4d" href="{{route('posters')}}"><h3>Афиша</h3></a>
                    <ul>
                        <li><a href="{{route('timetables')}}">Расписание</a></li>
                        <li><a href="{{route('soon')}}">Скоро в прокате</a></li>
                        <li><a href="{{route('cinemas')}}">Кинотеатры</a></li>
                        <li><a href="{{route('discounts')}}">Акции</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 col-md-3 item">
                    <a style="color: #4b4c4d" href="{{\App\Models\Page::where('page_id', 7)->first()->status == 1 ? route('page_id', 7) : '#'}}"><h3>О кинотеатре</h3></a>
                    <ul>
                        <li><a href="{{route('events')}}">&nbsp;Новости</a></li>
                        @foreach(\App\Models\Page::get() as $page)
                            @if($page->status == 1 && $page->page_id != 7)
                                @if($page->page_id == 5)
                                    <li><a href="{{route('page_mobile')}}">&nbsp;Мобильные прил</a></li>
                                @elseif($page->page_id == 6)
                                    <li><a href="{{route('page_cafe')}}">&nbsp;{{$page->name}}</a></li>
                                @else
                                    <li><a href="{{route('page_id', $page->page_id)}}">&nbsp;{{$page->name}}</a></li>
                                @endif
                            @endif
                        @endforeach
                        <li><a href="{{route('page_contacts')}}">&nbsp;Контакты</a></li>
                        <li><a href="{{route('user-cabinet')}}">&nbsp;Мой кабинет</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 item social">
                    <div class="social facebook">
                        <a href="#" target="_blank"><i class="fa fa-facebook fa-1x"></i></a>
                    </div>
                    <div class="social twitter">
                        <a href="#" target="_blank"><i class="fa fa-twitter fa-1x"></i></a>
                    </div>
                    <div class="social vk">
                        <a href="#" target="_blank"><i class="fa fa-vk fa-1x"></i></a>
                    </div>
                    <div class="social odnoklassniki">
                        <a href="#" target="_blank"><i class="fa fa-odnoklassniki fa-1x"></i></a>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <p class="copyright">©CinemaCMS 2016, All rights reserved</p>

                </div>
            </div>
        </div>
    </footer>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
