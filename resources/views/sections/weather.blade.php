<div class="container-fluid">
    <h1>Погода в Брянске</h1>
    <p>Сейчас в Брянске: {{ $weather['temp'] }}</p>
    <div class="icon-bryansk-temp">
        <img src="{{$weather['urlIconTemp']}}" alt="Погода в Брянске">
    </div>
    <p>Подробнее по ссылке: <a href="{{$weather['urlCity']}}">Погода в Брянске</a></p>
</div>