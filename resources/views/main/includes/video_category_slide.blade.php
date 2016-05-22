<div class="col-md-3">
     <h3 align="center" class="text-center featured-videos">CATEGORIES </h3>
     <ul class="list-group v-cat">
       @foreach($allCategories as $category)
       <li class="list-group-item"> 
        <a href="/video/category/{{ $category->name }}">
          <p class="img-circle"><i class="devicon-{{ strtolower($category->name) }}-plain colored"></i>  {{ $category->name }}</p>
        </a>
      </li>
      @endforeach
    </ul>
  </div>