@extends('layouts.v1')

@section('content')


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-4">

    </div>
    <div class="col-xl-12">
        <div class="row">
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <p class="text-muted fw-medium">Items</p>
                                <h4 class="mb-0">1,235</h4>
                            </div>

                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                <span class="avatar-title">
                                    <i class="bx bx-copy-alt font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <p class="text-muted fw-medium">Request and Issuance</p>
                                <h4 class="mb-0">23</h4>
                            </div>

                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-archive-in font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <p class="text-muted fw-medium">Purchase Request</p>
                                <h4 class="mb-0">12</h4>
                            </div>

                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <p class="text-muted fw-medium">Purchase Order</p>
                                <h4 class="mb-0">16</h4>
                            </div>

                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <p class="text-muted fw-medium">Inspection and Acceptance</p>
                                <h4 class="mb-0">21</h4>
                            </div>

                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Latest Transaction</h4>
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="align-middle">Transaction No.</th>
                                        <th class="align-middle">Date</th>
                                        <th class="align-middle">Transaction Type</th>
                                        <th class="align-middle">Prepared By</th>
                                        <th class="align-middle">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="javascript: void(0);" class="text-body fw-bold">PR-2022-06-00002</a></td>
                                        <td>2022-06-29</td>
                                        <td>Purchasse Request</td>
                                        <td>Jacob Hunter</td>
                                        <td>Approved</td>
                                    </tr>
                                    <tr>
                                        <td><a href="javascript: void(0);" class="text-body fw-bold">PR-2022-06-00001</a></td>
                                        <td>2022-06-28</td>
                                        <td>Purchasse Request</td>
                                        <td>Jacob Hunter</td>
                                        <td>Approved</td>
                                    </tr>
                                    <tr>
                                        <td><a href="javascript: void(0);" class="text-body fw-bold">PO-2022-06-00001</a></td>
                                        <td>2022-06-29</td>
                                        <td>Purchase Order</td>
                                        <td>Jacob Hunter</td>
                                        <td>Approved</td>
                                    </tr>

                                    <tr>
                                        <td><a href="javascript: void(0);" class="text-body fw-bold">IAR-2022-06-00001</a></td>
                                        <td>2022-06-29</td>
                                        <td>Inspection and Acceptance</td>
                                        <td>Jacob Hunter</td>
                                        <td>Approved</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection
