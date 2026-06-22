<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Invoice</title>
</head>
<body style="margin:0; padding:20px; font-family: Arial, sans-serif; background:#f9f9f9;">

  <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; margin:auto; background:#fff; border:1px solid #ddd;">
    
    <!-- Header -->
    <tr>
      <td style="padding:15px; border-bottom:1px solid #eee;">
        <h2 style="margin:0; font-size:18px;">INVOICE</h2>
        <p style="margin:5px 0 0; font-size:12px; color:#666;">Invoice #{{ $customer_requirement->order_number }}</p>
        <p style="margin:5px 0 0; font-size:12px; color:#666;">Date: {{ $customer_requirement->created_at->format('d F Y') }}</p>
        <p style="margin:5px 0 0; font-size:12px; color:#666;">Date: {{ $customer_requirement->deadline }}</p>

      </td>
    </tr>

    <!-- Company / Customer Info -->
    <tr>
      <td style="padding:15px; font-size:13px;">
        <table width="100%">
          <tr>
            <td style="vertical-align:top;">
              <strong>From:</strong><br>
              Your Company Name<br>
              address line 1<br>
              city, country
            </td>
            <td style="vertical-align:top; text-align:right;">
              <strong>To:</strong><br>
              {{ $customer_requirement->first_name }} {{ $customer_requirement->last_name }}<br>
              {{ $customer_requirement->address }}<br>
              {{ $customer_requirement->email }},
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Items Table -->
    <tr>
      <td style="padding:15px;">
        <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #ddd; border-collapse:collapse; font-size:13px;">
          
            @foreach ($customer_requirement->getLineItems() as $item)
              <tr>
                <td style="border:1px solid #ddd; padding:8px;">{{ $item->line_item }}</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">{{ $item->is_price ? $item->quantity : '' }}</td>
               
              </tr>
            @endforeach
          

         

        </table>
      </td>
    </tr>

    <!-- Total -->
    <tr>
      <td style="padding:15px; text-align:right; font-size:14px;">
        <strong>Total: 0.00</strong>
      </td>
    </tr>

    <!-- Footer -->
    <tr>
      <td style="padding:15px; border-top:1px solid #eee; font-size:12px; color:#777; text-align:center;">
        Thank you for your business!
      </td>
    </tr>

  </table>

</body>
</html>