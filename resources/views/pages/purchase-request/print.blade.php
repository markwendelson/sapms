<html>
  <head>
    <link rel="stylesheet" type="text/css" href="/css/report/a4.css">
    <style>
        body {
                font-family: Arial, Helvetica, sans-serif;
            }
        table, td, th {
            border: 1px solid;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
  </head>

    <body>
        <div class="main-page">
            <div class="sub-page">
              <div style="text-align: center; margin-bottom:40px;">
                <div>Republic of the Philippines</div>
                <div>City Government of Borongan</div>
                <div>Province of Easter Samar</div>
                <div>CITY GENERAL SERVICES OFFICE</div>
              </div>
              <div style="float: right; text-align:right; display: contents;">
                <div>Project Reference No.: <span style="margin-left:5px;width: 100px;border-bottom:solid 1px;display: inline-block;"></span></div>
                <div>Name of the Project:<span style="margin-left:5px;width: 100px;border-bottom:solid 1px;display: inline-block;"></span></div>
                <div>Location of the Project:<span style="margin-left:5px;width: 100px;border-bottom:solid 1px;display: inline-block;"></span></div>
              </div>
              <div>
                  <h3 align="center">PURCHASE REQUEST</h3>
              </div>
              <table style="margin-bottom:10px;">
                <tr>
                  <td>Department:</td>
                  <td>{{$pr->office->name}}</td>
                  <td>PR No.:</td>
                  <td>{{$pr->pr_no}}</td>
                  <td>Date:</td>
                  <td>{{ date_format(date_create($pr->requested_at),"m/d/Y")}}</td>
                </tr>
                <tr>
                  <td>Section:</td>
                  <td>{{$pr->section}}</td>
                  <td>SAI No.:</td>
                  <td colspan="2"></td>
                </tr>
              </table>

              <table style="margin-bottom:10px;">
                <thead>
                    <td>STOCK NO.</td>
                    <td>UNIT</td>
                    <td>ITEMS AND DESCRIPTION</td>
                    <td>QTY</td>
                    <td>UNIT COST</td>
                    <td>TOTAL COST</td>
                </tbody>
                <tbody>
                    @foreach ($pr->details as $key => $item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td></td>
                        <td>
                            <p>{{$item->item_name}}</p>
                            <p>{{$item->item_description}}</p>
                        </td>
                        <td>{{$item->quantity}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="4">CHARGES:</td>
                    <td>TOTAL</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan="6">Purpose/Remarks:</td>
                  </tr>
                  <tr>
                    <td colspan="2"></td>
                    <td>Requested by:</td>
                    <td colspan="3">Approved by:</td>
                  </tr>
                  <tr>
                    <td colspan="2">Signature</td>
                    <td></td>
                    <td colspan="3"></td>
                  </tr>
                  <tr>
                    <td colspan="2">Printed Name</td>
                    <td></td>
                    <td colspan="3"></td>
                  </tr>
                  <tr>
                    <td colspan="2">Designation</td>
                    <td></td>
                    <td colspan="3"></td>
                  </tr>
                  <tr>
                    <td colspan="2">Date</td>
                    <td></td>
                    <td colspan="3"></td>
                  </tr>
                </tfoot>
              </table>
              <div style="float: right; text-align:right; display: contents;">
                <div>(Reference PR No. :)</div>
              </div>
            </div>
        </div>
    </body>
</html>
