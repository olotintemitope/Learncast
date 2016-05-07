
 <div id="lista1" class="als-container slideInLeft animated">
  <span class="als-prev"><img src="images/thin_left_arrow_333.png" alt="prev" title="previous" />
  </span>
        <div class="als-viewport">
          <ul class="als-wrapper">
            @foreach($allCategories as $category)
            <li class="als-item">
              <a href="/video/category/{{ $category->name }}">
                <p class="img-circle">{{ $category->name }}</p>
              </a>
            </li>
            @endforeach
          </ul>
        </div>
        <span class="als-next"><img src="images/thin_right_arrow_333.png" alt="next" title="next" /></span>
</div>