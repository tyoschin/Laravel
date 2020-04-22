@php($categories = [
    'beauty',
    'restaurants',
    'health',
    'entertainment',
    'education',
    'auto',
    'fitness',
    'children',
    'various'
])

@php($categoryByIndex = mt_rand(0, count($categories)-1))

<div class="sale-item" data-tag-value="<?=isset($categoryByIndex) ? $categories[$categoryByIndex] : $categories[0] ?>">
    <img src="img/sale-logo.svg" alt=""/>
    <div class="sale-item__text">
        <p>{{ App\Models\Project::find($offer->project_id)->name }}</p>
    </div>
    <div class="sale-item__size"><span>{{$offer->name}}</div>
    <div class="sale-item__btn">
        <button class="bs-btn js-modal">Получить&nbsp;<span class="mobile-hidden">скидку</span></button>
    </div>
    <div class="sale-item__favorite js-favorite">
        <div class="no"><span class="mobile-visible">В избранное</span><span
                class="mobile-hidden">Добавить в избранное</span></div>
        <div class="yes"><span class="mobile-hidden">В избранном /&nbsp;</span>Удалить</div>
    </div>
</div>

@section('hidden-content')
    @include('plain.blocks.hidden', $offer)
@endsection
