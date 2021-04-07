<nav class="nav flex-column">
    @foreach($list as $row)
    {{-- logika class active disini jika label sama dengan variabel active yang dikirim kontroller sama, maka ditambahkan class active didalamya --}}
    <a class="nav-link {{$isActive($row['label']) ? 'active' : ''}}" href="{{route($row['route'])}}">
        <i class="{{$row['icon']}}"></i>
        {{ $row['label'] }}
    </a>
    @endforeach
</nav>

{{-- jika kamu menulis method/function dalam sebuah component, dia bisa langsung digunakan sebagai variabel dalam view bladenya mengirimkannya terlebih dahulu ke method render --}}