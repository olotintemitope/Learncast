@include('main.includes.header')
@include('main.includes.nav_bar')
@include('main.includes.top_section')
<section class="container-fluid" id="section2">
{{ session('data') }}
@include('main.includes.learning_content')
</section>
@include('main.includes.footer')