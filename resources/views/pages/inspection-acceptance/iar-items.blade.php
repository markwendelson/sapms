<table id="datatable" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
    <thead>
        <tr>
            <td>Stock No</td>
            <td>Unit</td>
            <td>Description</td>
            <td>Quantity</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        @foreach ($pr_items as $id => $item)
            <tr id="item-{{ $id }}">
                <td>
                    <a href="{{route('item.show',$item['item']['id'])}}">{{$item['item']['code']}}</a>
                </td>
                <td>{{$item['item']['unit_of_measure']}}</td>
                <td>{{$item['item']['description']}}</td>
                <td>{{$item['quantity']}}</td>
                <td>
                    <a href="javascript:void(0)" class="btn-remove">
                        <i data-id="{{ $id }}" class="bx bx-trash font-size-16 align-middle text-danger"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        @if(!count($pr_items))
        <tr>
            <td colspan="5">
                No matching records found.
            </td>
        </tr>
        @endif
    </tbody>
</table>
