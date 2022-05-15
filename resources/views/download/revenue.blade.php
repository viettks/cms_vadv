<table>
    <tr>
        <td colspan="11" style="text-align: center;font-weight: 500;font-size:25px; border:1px solid black;">
            Danh sách chi
        </td>
    </tr>
    <tr>
        <td width="150px"></td>
        <td width="150px"></td>
        <td width="150px"></td>
        <td width="150px"></td>
        <td width="150px"></td>
        <td width="150px"></td>
        <td width="150px"></td>
        <td width="150px"></td>
        <td width="150px"></td>
        <td width="150px"></td>
    </tr>
    <tr>
        <td style="font-weight: 500;border:1px solid black;">Ngày bắt đầu</td>
        <td style="font-weight: 500;border:1px solid black;">Ngày kết thúc</td>
        <td style="font-weight: 500;border:1px solid black;">Tình trạng</td>
        <td style="font-weight: 500;border:1px solid black;">Nhân viên</td>
        <td style="font-weight: 500;border:1px solid black;">Giá trị tìm kiếm</td>
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
        <td style="text-align: center;font-size:12px; border:1px solid black;">NGÀY</td>
        <td style="text-align: center;font-size:12px; border:1px solid black;">TÊN ĐỐI TÁC</td>
        <td style="text-align: center;font-size:12px; border:1px solid black;">LÝ DO CHI</td>
        <td style="text-align: center;font-size:12px; border:1px solid black;">SỐ TIỀN</td>
        <td style="text-align: center;font-size:12px; border:1px solid black;">NHÂN VIÊN</td>
        <td style="text-align: center;font-size:12px; border:1px solid black;">NGƯỜI DUYỆT</td>
        <td style="text-align: center;font-size:12px; border:1px solid black;">TRẠNG THÁI</td>
    </tr>
    @php
        $tempId = null;
    @endphp
    @foreach ($order['data'] as $item)
    <tr>
        <td style="border:1px solid black;">{{$item->create_date}}</td>
        <td style="border:1px solid black;">{{$item->name}}</td>
        <td style="border:1px solid black;">{{$item->note}}</td>
        <td style="border:1px solid black;">{{$item->amount}}</td>
        <td style="border:1px solid black;">{{$item->created_by}}</td>
        <td style="border:1px solid black;">{{$item->updated_by}}</td>
        <td style="border:1px solid black;">
        @if ($item->status == 2)
            Hoàn thành
        @elseif($item->status == 1)
            Từ chối
        @else
            Đang xử lý
        @endif
        </td>
    </tr>
    @endforeach
</table>