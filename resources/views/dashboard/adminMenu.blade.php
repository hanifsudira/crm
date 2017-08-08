<li class="active treeview menu-open">
    <a href="#">
        <i class="fa fa-dashboard"></i> <span>Posko</span>
        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{route('home.chart')}}"><i class="fa fa-circle-o"></i>Chart</a></li>
        <li><a href="{{route('home.data')}}"><i class="fa fa-circle-o"></i>Data Table</a></li>
        <li class="treeview menu-open">
            <a href="#"><i class="fa fa-circle-o"></i>Siebel Query
                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{route('ora.oraexcel')}}"><i class="fa fa-circle-o"></i>All Status</a></li>
                <li><a href="{{route('ora.lineitem')}}"><i class="fa fa-circle-o"></i>Line Item</a></li>
                <li><a href="{{route('ora.order')}}"><i class="fa fa-circle-o"></i>Order</a></li>
                <li><a href="{{route('ora.nossftenoss')}}"><i class="fa fa-circle-o"></i>Nossf-Tenoss</a></li>
            </ul>
        </li>
    </ul>
</li>