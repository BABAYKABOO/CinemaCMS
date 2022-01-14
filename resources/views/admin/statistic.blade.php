@extends('admin.admin')
@section('title', 'Статистика')
@section('content')
    <style>
        .circle {
            display: block;
            float: left;
        }
        circle {
            fill: rgba(0,0,0,0);
            stroke-width: 15;
            stroke-dasharray: 408px 408px;
        }
        circle:nth-child(2n) {
            fill: rgba(0,0,0,0);
            stroke: #30bae7;
            stroke-width: 15;
        }
        .gistogram{
            width: 600px;
            height: 400px;
            float:right;
        }
        .gistosgram-col{
            float:left;
            text-align: center;
            width: 100px;
            margin-left: 10px;
            color: white;
            background-color: #1f309f;
        }
    </style>
    <script src="http://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <h1>Hello Admin</h1>
    <div class="row" style="width: 99%; height:350px; margin-left: 10px;">
        <div class="col-4">
            <div class="row">
                <div class="col">
                    <div class="circle" style="color: pink">{{100 * count($users->where('sex', 0)->get()) / count($users->get())}}%</div>
                    <div class="row" style="width: max-content;height: 30px; margin: 0px 0px 0px 180px">
                        <div class="col" style="padding: 7px; height: 30px;"><div style="width: 10px; height: 10px; background-color: #30bae7;"></div></div>
                        <div class="col" style="height: 30px;">Мужчины</div>
                    </div>
                    <div class="row" style="width: max-content;height: 30px; margin: 0px 0px 0px 180px">
                        <div class="col" style="padding: 7px; height: 30px;"><div style="width: 10px; height: 10px; background-color: pink;"></div></div>
                        <div class="col" style="height: 30px;">Женщины</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="circle" style="color: green">{{100 * count($users->where('ua_ru', 1)->get()) / count($users->get())}}%%</div>
                    <div class="row" style="width: max-content;height: 30px; margin: 0px 0px 0px 180px">
                        <div class="col" style="padding: 7px; height: 30px;"><div style="width: 10px; height: 10px; background-color: #30bae7;"></div></div>
                        <div class="col" style="height: 30px;">Русский</div>
                    </div>
                    <div class="row" style="width: max-content;height: 30px; margin: 0px 0px 0px 180px">
                        <div class="col" style="padding: 7px; height: 30px;"><div style="width: 10px; height: 10px; background-color: green;"></div></div>
                        <div class="col" style="height: 30px;">Украинский</div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col">
            <div class="row" style="width: 500px; float:right; height: 200px; color:white; background-color: #f5c81c">
                <div class="col">
                    <span style="font-size: 50px; margin-left: 30px; margin-top: 60px;">{{count($users->get())}}</span>
                    <p style="font-size: 20px;">Зарегистрированных</p>
                    <p style="font-size: 20px;">пользователей</p>
                </div>
                <div class="col">
                    <img style="width: 125px;float: right; margin-top: 30px" src="http://cinema.com/storage/img/user_icon.png"/>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="width: 99%; height:500px; margin-left: 10px;">
        <div class="col-5" style="padding-right: 20px;">
            <div style="padding: 10px; border-radius: 15px;">
            <h1>Куплено билетов за</h1>
            <label>От:</label>
            <input class="form-control item" style="width: 190px; display: inline;" type="date" name="from_when"/>
            <label>До:</label>
            <input class="form-control item" style="width: 190px; display: inline;" type="date" name="to_when"/>
            <div style="background-color: #f5c81c; height: 200px; width: 90%; margin: 0 auto; color: white; margin-top: 30px; text-align:center; padding-top: 35px;  border-radius: 15px;">
                <h2>Билетов: 150</h2><br/>
                <h2>Прибыль: 150000 грн</h2>
            </div>
            </div>
        </div>
        <div class="col-7" style="padding: 10px;border: 1px solid black; border-radius: 15px;">
            <h1>Самые популярные фильмы за</h1>
            <label>От:</label>
            <input class="form-control item" style="width: 200px; display: inline;" type="date" name="from_when"/>
            <label>До:</label>
            <input class="form-control item" style="width: 200px; display: inline;" type="date" name="to_when"/>
            <div id="d3-container" ></div>
        </div>
    </div>
    <div class="row" style="height: 600px; margin-top: 50px; width: 99%; margin-left: 20px;">
    <div class="col">
        <div style="border: 1px solid black; padding: 10px; border-radius: 15px; width: 600px;">
            <h1>Количество сеансов</h1>
            <label>От:</label>
            <input class="form-control item" style="width: 190px; display: inline;" type="date" name="from_when"/>
            <label>До:</label>
            <input class="form-control item" style="width: 190px; display: inline;" type="date" name="to_when"/>
            <div class="chart1" style="width: 90%; height: 400px; margin-top: 20px;"></div>
        </div>
    </div>
    <div class="col" style="padding: 10px;">
        <h1>Типы устройств пользователей</h1>
        <div style="margin: 50px 0px 0px 250px ">
        <div class="circle" style="color: #c40900">{{100 * count($users->where('sex', 0)->get()) / count($users->get())}}%</div>
        <div class="row" style="width: max-content;height: 30px; margin: 0px 0px 0px 180px">
            <div class="col" style="padding: 7px; height: 30px;"><div style="width: 10px; height: 10px; background-color: #30bae7;"></div></div>
            <div class="col" style="height: 30px;">ПК</div>
        </div>
        <div class="row" style="width: max-content;height: 30px; margin: 0px 0px 0px 180px">
            <div class="col" style="padding: 7px; height: 30px;"><div style="width: 10px; height: 10px; background-color: #c40900;"></div></div>
            <div class="col" style="height: 30px;">Телефоны</div>
        </div>
        </div>
    </div>
    </div>
    <script>
        new Chartist.Line('.chart1', {
            labels: ['День 1', 'День 2', 'День 3', 'День 4', 'День 5'],
            series: [
                [12, 9, 3, 8, 4],
            ]
        }, {
            fullWidth: true,
            chartPadding: {
                right: 50
            }
        });
    </script>
    <script>
        const data = [
            { name: '{{$books_movie[0]->name}}', score: {{$books_movie[0]->count}} },
            { name: '{{$books_movie[1]->name}}', score: {{$books_movie[1]->count}} },
            { name: '{{$books_movie[1]->name}}', score: {{$books_movie[1]->count}} },
            { name: '{{$books_movie[1]->name}}', score: {{$books_movie[1]->count}} },
            { name: '{{$books_movie[1]->name}}', score: {{$books_movie[1]->count}} },
        ];

        const width = 750;
        const height = 450;
        const margin = { top: 50, bottom: 50, left: 0, right: 60 };

        const svg = d3.select('#d3-container')
            .append('svg')
            .attr('width', width - margin.left - margin.right)
            .attr('height', height - margin.top - margin.bottom)
            .attr("viewBox", [0, 0, width, height]);

        const x = d3.scaleBand()
            .domain(d3.range(data.length))
            .range([margin.left, width - margin.right])
            .padding(0.1)

        const y = d3.scaleLinear()
            .domain([0, {{$books_movie[0]->count}} + 10])
            .range([height - margin.bottom, margin.top])

        svg
            .append("g")
            .attr("fill", 'royalblue')
            .selectAll("rect")
            .data(data.sort((a, b) => d3.descending(a.score, b.score)))
            .join("rect")
            .attr("x", (d, i) => x(i))
            .attr("y", d => y(d.score))
            .attr('title', (d) => d.score)
            .attr("class", "rect")
            .attr("height", d => y(0) - y(d.score))
            .attr("width", x.bandwidth());

        function yAxis(g) {
            g.attr("transform", `translate(${margin.left}, 0)`)
                .call(d3.axisLeft(y).ticks(null, data.format))
                .attr("font-size", '15px')
        }

        function xAxis(g) {
            g.attr("transform", `translate(0,${height - margin.bottom})`)
                .call(d3.axisBottom(x).tickFormat(i => data[i].name))
                .attr("font-size", '15px')
        }

        svg.append("g").call(xAxis);
        svg.append("g").call(yAxis);
        svg.node();


    </script>
    <script>
        var Circle = function(sel){
            var circles = document.querySelectorAll(sel);
            [].forEach.call(circles,function(el){
                var valEl = parseFloat(el.innerHTML);
                var color = $(el).css('color');
                valEl = valEl*408/100;
                el.innerHTML = '<svg width="160" height="160"><circle style="stroke: ' + color +';" transform="rotate(-90)" r="65" cx="-80" cy="80" /><circle transform="rotate(-90)" style="stroke-dasharray:'+valEl+'px 408px;" r="65" cx="-80" cy="80" /></svg>';

            });
        };
        Circle('.circle');
    </script>
@endsection
