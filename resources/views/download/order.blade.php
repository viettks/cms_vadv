<style>
    td{
        min-width: 200px;
    }
</style>
<table>
    <thead>
        <tr>
            <td colspan="11" style="text-align: center"><h1>Danh sách đơn hàng</h1></td>
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
            <th>Ngày</th>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <td>LOẠI IN</td>
            <td>GIA CÔNG</td>
            <td>HỖ TRỢ</td>
            <td>NGANG</td>
            <td>DỌC</td>
            <td>SỐ LƯỢNG</td>
            <td>ĐƠN GIÁ</td>
            <td>TỔNG</td>
            <td>THÀNH TIỀN</td>
            </tr>
    </thead>
    <tbody>
        @php
        $tempId = null;
        @endphp
        @foreach ($order['data'] as $item)

        <tr>
            <td>
                @if ($tempId != $item->id)
                    {{$item->create_date}}
                @endif
            </td>
            <td>
                @if ($tempId != $item->id)
                {{$item->customer}}
                @endif
            </td>
            <td>
                @if ($tempId != $item->id)
                {{$item->phone}}
                @endif
            </td>
            <td>{{$item->width}}</td>
            <td>{{$item->heigth}}</td>
            <td>{{$item->quantity}}</td>
            <td>{{$item->unit_price}}</td>
            <td>{{$item->amount}}</td>
            <td>                
                @if ($tempId != $item->id)
                {{$item->total}}
                @endif
            </td>
            <td>               
                @if ($tempId != $item->id)
                    @if ($item->status == 1)
                        Hoàn thành
                    @else
                        Chưa hoàn thành
                    @endif
                    @php
                        $tempId = $item->id;
                    @endphp
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>