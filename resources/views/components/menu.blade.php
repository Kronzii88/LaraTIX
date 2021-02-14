<nav class="nav flex-column">
    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
    @foreach($list as $row)
    <a class="nav-link {{$isActive($row['label']) ? 'active' : ''}}" href=#>
        {{ $row['label'] }}
    </a>
    @endforeach
</nav>
