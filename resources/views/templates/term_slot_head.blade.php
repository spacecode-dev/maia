@section('robots_all', robots_all($key, $term->index))
@section('robots_google', robots_google($key, $term->index))
@section('robots_yandex', robots_yandex($key, $term->index))
@section('robots_bing', robots_bing($key, $term->index))
@section('robots_yahoo', robots_yahoo($key, $term->index))
@section('robots_duck', robots_duck($key, $term->index))
@section('robots_baidu', robots_baidu($key, $term->index))
@section('document_state', state($key, $term->document_state))
@section('meta_title', meta_title($key, $url, $term))
@section('meta_description', meta_description($key, $url, $term))
@section('meta_keywords', meta_keywords($key, $url, $term))
@section('json_ld', json_ld($key, $url, $term))
@section('open_graph', open_graph($key, $url, $term))
@section('parent', isParent($single))
@section('paginationFirst', isPagination($single, 'first'))
@section('paginationLast', isPagination($single, 'last'))
@section('paginationNext', isPagination($single, 'next'))
@section('paginationPrev', isPagination($single, 'prev'))