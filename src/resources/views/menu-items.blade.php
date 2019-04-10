@foreach($menu as $groupName => $group)
    @canany($group->pluck('can'))
        @if(!empty($groupName))
            <li class="treeview">
                <a href="#">{!! $groupName !!}<i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @endif
                    @foreach($group as $m)
                        @can($m['can'] ?? "dashboard")
                            <li>
                                <a href="{{ backpack_url($m['route'] ?? $m['id']) }}">
                                    <i class="{{ $m['route_ico'] ?? 'fa fa-plug' }}"></i>
                                    <span>{{ $m['route_name'] ?? $m['id'] }}</span>
                                </a>
                            </li>
                        @endcan
                    @endforeach
                    @if(!empty($groupName))
                </ul>
            </li>
        @endif
    @endcan
@endforeach