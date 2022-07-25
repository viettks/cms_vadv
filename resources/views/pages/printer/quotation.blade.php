<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Emulating real sheets of paper in web documents (using HTML and CSS)">
    <title>Sheets of Paper</title>
    <link rel="stylesheet" type="text/css" href="css/sheets-of-paper-a4.css">
    <link href="{{URL::asset('css/print/sheets-of-paper-a4.css')}}" rel="stylesheet" media="all">
    <style>
        p + p {
            margin-top: 0.1cm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, td, th {
            border: 1px solid;
        }

        table>thead>tr{
            background-color: aqua;
        }

        table>thead>tr>td{
            font-weight: 500;
            text-align: center;
        }
    </style>
</head>

<body class="document">
    <div class="page" contenteditable="false">
        <section>
            <div style="display: flex">
                <div style="width: 30%;">
                    <img src="http://localhost:8000/images/icon/tao-ke-hoach-in.png" alt="tao-ke-hoach-in"
                        style="width: 150px;">
                </div>
                <div style="width: 70%; text-align: center">
                    <h2><p>CÔNG TY TNHH QUẢNG CÁO VIETADV</p></h2>
                    <p>Đ/C: 191/5 Dương Văn Dương P.Tân Quý Q.Tân Bình</b></p>
                    <p>ĐT: 0938375907, Mr Khang </p>
                    <p>Email: cskh@vietadv.com.vn</p>
                    <p>TK: 4939999995- VP Bank - Nguyễn Sòng</p>
                </div>
        </section>
        <section>
            <br>
            <p style="text-align: center; color: red; font-size: 1.8em;font-weight:500;"> BÁO GIÁ IN ẤN</p>
            <p><b>Công ty VIETADV xin kính gửi đến quý công ty báo giá sản phẩm mà quý đơn vị đang quan tâm như sau:</b></p>
            <br>
            <table>
                <thead>
                    <tr>
                        <td>STT</th>
                        <td>TÊN SẢN PHẨM</th>
                        <td>QUY CÁCH</th>
                        <td>SỐ LƯỢNG</th>
                        <td>TỔNG</th>
                        <td>ĐƠN GIÁ</th>
                        <td>THÀNH TIỀN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">TỔNG</td>
                        <td>1,600,000</td>
                    </tr>
                    <tr>
                        <td colspan="6">VAT (10%)</td>
                        <td>1,600,000</td>
                    </tr>
                    <tr>
                        <td colspan="6">TỔNG ĐƠN HÀNG SAU VAT</td>
                        <td>1,600,000</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <ul>
            <li>li1</li>
            <li>li1</li>
            <li>li1</li>
            <li>li1</li>
            <li>li1</li>
            <li>li1</li>
        </ul>
        <section>
    </div>
    <script type="text/javascript">
        // window.print();

		var Config = {};
		Config.pixelsPerInch = 96;
		Config.pageHeightInCentimeter = 29.7; // must match 'min-height' from 'css/sheets-of-paper-*.css' being used
		Config.pageMarginBottomInCentimeter = 2; // must match 'padding-bottom' and 'margin-bottom' from 'css/sheets-of-paper-*.css' being used

		window.addEventListener("DOMContentLoaded", function () {
			applyPageBreaks();
		});

		function applyPageBreaks() {
			applyManualPageBreaks();
			applyAutomaticPageBreaks(Config.pixelsPerInch, Config.pageHeightInCentimeter, Config.pageMarginBottomInCentimeter);

			document.querySelectorAll(".document .page").forEach(function (element) {
				if (!element.classList.contains("has-events")) {
					element.addEventListener("blur", function () {
						applyPageBreaks();
					});

					element.classList.add("has-events");
				}
			});
		}

		/* Applies any manual page breaks in preview mode (screen, non-print) where CSS Paged Media is not fully supported */
		function applyManualPageBreaks() {
			var docs, pages, snippets;
			docs = document.querySelectorAll(".document");

			for (var d = docs.length - 1; d >= 0; d--) {
				pages = docs[d].querySelectorAll(".page");

				for (var p = pages.length - 1; p >= 0; p--) {
					snippets = pages[p].children;

					for (var s = snippets.length - 1; s >= 0; s--) {
						if (snippets[s].classList.contains("page-break")) {
							pages[p].insertAdjacentHTML("afterend", "<div class=\"page\" contenteditable=\"true\"></div>");

							for (var n = snippets.length - 1; n > s; n--) {
								pages[p].nextElementSibling.insertBefore(snippets[n], pages[p].nextElementSibling.firstChild);
							}

							snippets[s].remove();
						}
					}
				}
			}
		}

		/* Applies (where necessary) automatic page breaks in preview mode (screen, non-print) where CSS Paged Media is not fully supported */
		function applyAutomaticPageBreaks(pixelsPerInch, pageHeightInCentimeter, pageMarginBottomInCentimeter) {
			var inchPerCentimeter = 0.393701;
			var pageHeightInInch = pageHeightInCentimeter * inchPerCentimeter;
			var pageHeightInPixels = Math.ceil(pageHeightInInch * pixelsPerInch);
			var pageMarginBottomInInch = pageMarginBottomInCentimeter * inchPerCentimeter;
			var pageMarginBottomInPixels = Math.ceil(pageMarginBottomInInch * pixelsPerInch);
			var docs, pages, snippets, pageCoords, snippetCoords;
			docs = document.querySelectorAll(".document");

			for (var d = docs.length - 1; d >= 0; d--) {
				pages = docs[d].querySelectorAll(".page");

				for (var p = 0; p < pages.length; p++) {
					if (pages[p].clientHeight > pageHeightInPixels) {
						pages[p].insertAdjacentHTML("afterend", "<div class=\"page\" contenteditable=\"true\"></div>");
						pageCoords = pages[p].getBoundingClientRect();
						snippets = pages[p].querySelectorAll("h1, h2, h3, h4, h5, h6, p, ul, ol");

						for (var s = snippets.length - 1; s >= 0; s--) {
							snippetCoords = snippets[s].getBoundingClientRect();

							if ((snippetCoords.bottom - pageCoords.top + pageMarginBottomInPixels) > pageHeightInPixels) {
								pages[p].nextElementSibling.insertBefore(snippets[s], pages[p].nextElementSibling.firstChild);
							}
						}

						pages = docs[d].querySelectorAll(".page");
					}
				}
			}
		}
    </script>
</body>

</html>