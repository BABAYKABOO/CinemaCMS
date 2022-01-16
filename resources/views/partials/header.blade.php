<div>
    <div class="container mt-5" style="text-align: center;">
        <div class="row">
            <div class="col-4">
                <a href="{{route('main')}}"><img class="logo" src="http://cinema.com/storage/img/logo.png" alt="logo"></a>
            </div>
            <div class="col-8" style="overflow: hidden;">
                <div class="header-column" style="width: 200px">
                    <form  action="{{route('posters-search')}}" method="get">
                        <input name="movie_name" type="text" id="search" placeholder="Поиск" style="border: 2px solid black" />
                        <button id="do_search" type="submit" style="display: none"></button>
                    </form>
                    <script>
                        $("body").on("change", "#search", function () {
                            $('#do_search').click();
                        });
                    </script>
                </div>
                <div class="header-column" style="width: 250px">
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
                    <div class="social github">
                        <a href="#" target="_blank"><i class="fa fa-github fa-1x"></i></a>
                    </div>
                    <div class="social google-pluse">
                        <a href="#" target="_blank"><i class="fa fa-google-plus fa-1x"></i></a>
                    </div>
                </div>
                <div class="header-column" style="width: 200px">
                    <h4>{{\App\Models\PageMain::first()->phone_1}}</h4>
                    <h4>{{\App\Models\PageMain::first()->phone_2}}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3" style="height: 30px"></div>
            <div class="col-8" style="border: 1px solid black; background-color: white; height: 30px">
                <nav>
                    <ul>
                        <li class="menu"><a href="{{route('posters')}}">Афиша</a></li>
                        <li class="menu"><a href="{{route('timetables')}}">Расписание</a></li>
                        <li class="menu"><a href="{{route('soon')}}">Скоро</a></li>
                        <li class="menu"><a href="{{route('cinemas')}}">Кинотеатры</a></li>
                        <li class="menu"><a href="{{route('discounts')}}">Акции</a></li>
                        <li class="menu"><a href="{{\App\Models\Page::where('page_id', 7)->first()->status == 1 ? route('page_id', 7) : '#'}}">О кинотеатре</a>
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
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="col-1" style="height: 30px">
                <select style="height: 30px; width: 60px">
                    <option>Рус</option>
                    <option>Укр</option>
                </select>
            </div>
        </div>
    </div>
</div>
</div>
