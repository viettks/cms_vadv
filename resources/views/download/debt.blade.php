<table>
    <tr>
        <td colspan="12" style="text-align: center;font-weight: 500;font-size:25px; border:1px solid black;">
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
        <td style="font-weight: 500;border:1px solid black;">Ngày kết tdúc</td>
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
        <td style="text-align: center;font-size:12px; border:1px solid black;">TÊN KHÁCH HÀNG</td>
        <td style="text-align: center;font-size:12px; border:1px solid black;">SỐ ĐIỆN tdOẠI</td>
        <td style="text-align: center;font-size:12px; border:1px solid black;">TỒNG TIỀN</td>
        <td style="text-align: center;font-size:12px; border:1px solid black;">CHI TRẢ</td>
        <td style="text-align: center;font-size:12px; border:1px solid black;">NỢ</td>
        <td style="text-align: center;font-size:12px; border:1px solid black;">TÌNH TRẠNG</td>
        @php
        $tempId = null;
        @endphp
        @foreach ($items['data'] as $item)
    <tr>
        <td style="border:1px solid black;">{{$item->create_date}}</td>
        <td style="border:1px solid black;">{{$item->name}}</td>
        <td style="border:1px solid black;">{{$item->phone}}</td>
        <td style="border:1px solid black;">{{$item->amount}}</td>
        <td style="border:1px solid black;">{{$item->payment}}</td>
        <td style="border:1px solid black;">{{$item->debt}}</td>
        <td style="border:1px solid black;">
            @if ($item->status == 1)
            Hoàn tdành
            @else
            @if ($item->debt_date <=15) <p class="text-danger">Dưới 15 ngày.</p>
                @elseif($item->debt_date > 30)
                <p class="text-danger">Trên 30 ngày.</p>
                @else
                <p class="text-danger">Trên 15 ngày.</p>
                @endif
                @endif
        </td>
    </tr>
    @endforeach
</table>