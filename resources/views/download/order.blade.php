<style>
    td{
        min-width: 200px;
    }
</style>
<table>
    <thead>
        <tr>
            <td colspan="12" style="text-align: center"><h1>Danh sách đơn hàng</h1></td>
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
            <th>Chi tiết</th>
            <th>KT ngang</th>
            <th width="150px" style="">KT dọc</th>
            <th width="150px">Tổng</th>
            <th width="150px">Đơn giá</th>
            <th width="150px">Thành tiền</th>
            <th width="150px">Tổng tiền</th>
            <th width="150px">Tình trạng</th>
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
            @php
                $chitiet = '';
                $chitiet .= $item->manufac1 ? $item->manufac2 . ',':'';
                $chitiet .= $item->manufac2 ? $item->manufac2 :'';
                $chitiet = $chitiet == '' ? $item->name : $item->name . '(' .$chitiet .')';
            @endphp
            <td>{{$chitiet}}</td>
            <td>{{$item->width == 0 ? "" : $item->width}}</td>
            <td>{{$item->heigth == 0 ? "" : $item->heigth}}</td>
            <td>{{$item->unit_total .' ' .$item->unit_name}}</td>
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