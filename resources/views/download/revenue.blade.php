<style>
    td{
        min-width: 200px;
    }
</style>
<table>
    <thead>
        <tr>
            <td colspan="11" style="text-align: center"><h1>Danh sách chi</h1></td>
        </tr>
        <tr>
            <td width="150px">Ngày bắt đầu</td>
            <td width="150px">Ngày kết thúc</td>
            <td width="150px">Tình trạng</td>
            <td width="150px">Nhân viên</td>
            <td width="150px">Giá trị tìm kiếm</td>
        </tr>
        <tr>
            <td>{{$search['fromDate']}}</td>
            <td>{{$search['toDate']}}</td>
            <td>{{$search['status']}}</td>
            <td>{{$search['staff']}}</td>
            <td>{{$search['value']}}</td>
        </tr>
        <tr></tr>
        <tr>                                
            <th>NGÀY</th>
            <th>TÊN ĐỐI TÁC</th>
            <th>LÝ DO CHI</th>
            <th>SỐ TIỀN</th>
            <th>NHÂN VIÊN</th>
            <th width="150px">NGƯỜI DUYỆT</th>
            <th width="150px">TRẠNG THÁI</th>
    </thead>
    <tbody>
        @php
        $tempId = null;
        @endphp
        @foreach ($order['data'] as $item)

        <tr>
            <th>{{$item->create_date}}</th>
            <th>{{$item->name}}</th>
            <th>{{$item->note}}</th>
            <th>{{$item->amount}}</th>
            <th>{{$item->created_by}}</th>
            <th>{{$item->updated_by}}</th>
            <th>
                @if ($item->status == 2)
                Hoàn thành
                @elseif($item->status == 1)
                Từ chối
                @else
                Đang xử lý
                @endif
            </th>
        </tr>
        @endforeach
    </tbody>
</table>