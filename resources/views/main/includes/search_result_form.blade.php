
<div class="container v-center">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <h2>
                        {{ count($searchResult) }} results found for: <span class="text-navy">{{ $decodedString }}</span>
                    </h2>
                    @foreach($searchResult as $video)
                    <div class="hr-line-dashed"></div>
                    <div class="search-result">
                        <h3><a href="/view/video/{{ $video->id}}">{{ ucwords($video->title) }}</a></h3>
                        <a href="/view/video/{{ $video->id}}" class="search-link">{{ $_SERVER['HTTP_HOST'] }}/view/video/{{ $video->id}}</a>
                        <p>{{  $video->description }}</p>
                    </div>
                    @endforeach
                    <div class="hr-line-dashed"></div>
                    
                    <div class="text-center">
                        <div class="btn-group">
                            <!-- Pagination -->
                            {!! $searchResult->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                    