<div class="container">
   <div class="row">
      <div class="col-lg-12">
      <h3 align="center">Video Categories</h3>
          <div class="slider autoplay responsive slideInLeft animated">
              @foreach($allCategories as $category)
              <div>
                <a href="/video/category/{{ $category->name }}">
                  <p class="img-circle">{{ $category->name }}</p>
                </a>
              </div>
              @endforeach
          </div>
        </div>
    </div>
</div>