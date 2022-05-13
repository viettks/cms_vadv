<style>
    td{
        min-width: 200px;
    }
</style>
<table>
    <thead>
        <tr></tr>
        <tr>
            <td colspan="12" style="text-align: center;font-weight: 500;font-size:25px; border:1px solid black;">
                <h1>Danh sách đơn hàng</h1>
            </td>
        </tr>
        <tr></tr>
        <tr>
            <td width="150px" style="font-weight: 500;border:1px solid black;">Ngày bắt đầu</td>
            <td width="150px" style="font-weight: 500;border:1px solid black;">Ngày kết thúc</td>
            <td width="150px" style="font-weight: 500;border:1px solid black;">Tình trạng</td>
            <td width="350px" style="font-weight: 500;border:1px solid black;">Nhân viên</td>
            <td width="150px" style="font-weight: 500;border:1px solid black;">Giá trị tìm kiếm</td>
            <td width="150px"></td>
            <td width="150px"></td>
            <td width="150px"></td>
            <td width="150px"></td>
            <td width="150px"></td>
        </tr>
        <tr>
            <td style="border:1px solid black;">{{$search['fromDate']}}</td>
            <td style="border:1px solid black;">{{$search['toDate']}}</td>
            <td style="border:1px solid black;">{{$search['status']}}</td>
            <td style="border:1px solid black;">{{$search['staff']}}</td>
            <td style="border:1px solid black;">{{$search['value']}}</td>
        </tr>
        <tr></tr>
        <tr>                                
            <th style="text-align: center;font-size:12px; border:1px solid black;">NGÀY</th>
            <th style="text-align: center;font-size:12px; border:1px solid black;">TÊN KHÁCH HÀNG</th>
            <th style="text-align: center;font-size:12px; border:1px solid black;">SỐ ĐIỆN THOẠI</th>
            <th style="text-align: center;font-size:12px; border:1px solid black;">CHI TIẾT</th>
            <th style="text-align: center;font-size:12px; border:1px solid black;">KÍCH THƯỚC</th>
            <th style="text-align: center;font-size:12px; border:1px solid black;">TỔNG</th>
            <th style="text-align: center;font-size:12px; border:1px solid black;">ĐƠN GIÁ</th>
            <th style="text-align: center;font-size:12px; border:1px solid black;">THÀNH TIỀN</th>
            <th style="text-align: center;font-size:12px; border:1px solid black;">TỔNG TIỀN</th>
            <th style="text-align: center;font-size:12px; border:1px solid black;">TÌNH TRẠNG</th>
        </tr>
    </thead>
    <tbody>
        @php
        $tempId = null;
        @endphp
        @foreach ($order['data'] as $item)

        <tr>
            <td style="border:1px solid black;">
                @if ($tempId != $item->id)
                    {{$item->create_date}}
                @endif
            </td>
            <td style="border:1px solid black;">
                @if ($tempId != $item->id)
                {{$item->customer}}
                @endif
            </td>
            <td style="border:1px solid black;">
                @if ($tempId != $item->id)
                {{$item->phone}}
                @endif
            </td>
            <td style="border:1px solid black;">{{$item->detail}}</td>
            <td style="border:1px solid black;">{{$item->size}}</td>
            <td style="border:1px solid black;">{{$item->total_size}}</td>
            <td style="border:1px solid black;">{{$item->unit_price}}</td>
            <td style="border:1px solid black;">{{$item->amount_display}}</td>
            <td style="border:1px solid black;">                
                @if ($tempId != $item->id)
                {{$item->total_amount}}
                @endif
            </td>
            <td style="border:1px solid black;">               
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