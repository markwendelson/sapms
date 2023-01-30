<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                @can('view-supplies')
                    <li>
                        <a href="{{route('item.index')}}" class="waves-effect">
                            <i class="bx bxs-box"></i>
                            <span key="t-items">Supplies</span>
                        </a>
                    </li>
                @endcan

                @can('view-supply-availability-inquiry')
                    <li>
                        <a href="{{route('supplies-availability-inquiry')}}" class="waves-effect">
                            <i class="bx bxs-help-circle"></i>
                            <span key="t-sai">Supplies Availability Inquiry</span>
                        </a>
                    </li>
                @endcan


                @can('view-requisition-and-issuance')
                    <li>
                        <a href="{{route('requisition-and-issuance.index')}}" class="waves-effect">
                            <i class="bx bx-spreadsheet"></i>
                            <span key="t-ris">Requisition and Issuance</span>
                        </a>
                    </li>
                @endcan

                @can('view-purchase-request')
                    <li>
                        <a href="{{route('purchase-request.index')}}" class="waves-effect">
                            <i class="bx bx-receipt"></i>
                            <span key="t-p-request">Purchase Request</span>
                        </a>
                    </li>
                @endcan

                @can('view-purchase-order')
                    <li>
                        <a href="{{route('purchase-order.index')}}" class="waves-effect">
                            <i class="bx bxs-cart-alt"></i>
                            <span key="t-p-order">Purchase Order</span>
                        </a>
                    </li>
                @endcan

                @can('view-inspection-and-acceptance')
                    <li>
                        <a href="{{route('inspection-and-acceptance.index')}}" class="waves-effect">
                            <i class="bx bx-list-check"></i>
                            <span key="t-ins">Inspection and Acceptance</span>
                        </a>
                    </li>
                @endcan

                <li>
                    <a href="/transfer-material" class="waves-effect">
                        <i class="bx bx-list-check"></i>
                        <span key="t-b-transfer-material">Transfer Material</span>
                    </a>
                </li>

                <li>
                    <a href="/biological-assets" class="waves-effect">
                        <i class="bx bx-list-check"></i>
                        <span key="t-b-waste-materials">Waste Material</span>
                    </a>
                </li>

                @can('view-reports')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-briefcase-alt-2"></i>
                            <span key="t-projects">Reports</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('reports')}}" key="t-stock-card">Stock Card</a></li>
                            <li><a href="{{route('reports')}}" key="t-property-card">Property Card</a></li>
                            <li><a href="{{route('reports')}}" key="t-rsmi">Report of Supplies and Materials Issued</a></li>
                            <li><a href="{{route('reports')}}" key="t-pci">Physical Count of Inventories</a></li>
                            <li><a href="{{route('reports')}}" key="t-pcpe">Physical Count of Property, Plant and Equipment</a></li>
                            <li><a href="{{route('reports')}}" key="t-wmr">Waste Material Report</a></li>
                            <li><a href="{{route('reports')}}" key="t-lup">List of Unserviceable Property</a></li>
                            <li><a href="{{route('reports')}}" key="t-iarup">Inventory and Inspection Report of Unserviceable Property</a></li>
                            <li><a href="{{route('reports')}}" key="t-ppelc">Property, Plant and Equipment Ledger Card</a></li>
                        </ul>
                    </li>
                @endcan

                @hasanyrole('super-admin|admin')
                    <li class="menu-title" key="t-utilities">Utilities</li>

                    <li>
                        <a href="{{route('user.index')}}" class="waves-effect">
                            <i class="bx bxs-user-circle"></i>
                            <span key="t-users">Users</span>
                        </a>
                    </li>

                    {{-- <li>
                        <a href="{{route('uac')}}" class="waves-effect">
                            <i class="bx bxs-user-detail"></i>
                            <span key="t-uac">User Access Control</span>
                        </a>
                    </li> --}}

                    {{-- <li>
                        <a href="{{route('approval')}}" class="waves-effect">
                            <i class="bx bxs-user-check"></i>
                            <span key="t-approval">Approval List</span>
                        </a>
                    </li> --}}

                    <li>
                        <a href="{{route('office.index')}}" class="waves-effect">
                            <i class="bx bxs-group"></i>
                            <span key="t-offices">Offices</span>
                        </a>
                    </li>
                @endrole

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
