const urlparams = new URLSearchParams(window.location.search);
const cart = urlparams.get("cart");
const decode = JSON.parse(decodeURIComponent(cart));
console.log(decode);

let orderContent = ``;
let total = parseFloat(urlparams.get("total"));
let currency = urlparams.get("currency");

decode.forEach(item => {
  orderContent += `
  <div style="display:flex;align-items:flex-start;background:#020617;padding:20px;border-radius:14px;margin-bottom:20px;">
    <img src="${item.game_pic}" style="width:80px;height:80px;border-radius:10px;object-fit:cover;margin-right:20px;">
    <div style="color:#bdc3c7;line-height:1.8;padding-top:2px;">
      <div style="font-size:16px;font-weight:700;color:#e5e7eb;margin-bottom:12px;">
        ${item.name}
      </div>

      <div style="margin-bottom:10px;font-size:14px;">
        Quantity: <b>${item.quantity}</b>
      </div>

      <div style="margin-top:14px;font-size:15px;font-weight:600;color:#22c55e;">
        Price: ${item.prize} ${currency}
      </div>
    </div>
  </div>
  `;
});


orderContent += `
<hr style="border:1px solid #1e293b">
<p style="text-align:right;font-size:16px;color:#facc15"><b>Total: ${total.toFixed(2)} ${currency}</b></p>`

emailjs.init("2w8KrX-es6cBuW9Rt");

const params = {
  name: "",
  title: "Order Summary",
  welcome: "Your Order has arrived",
  introduction:"Thanks for your purchase at Fragstore! We’re excited to let you know that your order was successful. Below you’ll find a summary of what you ordered, including quantities and pricing. If you have any questions or need help with your order, feel free to reply to this email — we’ve got your back.",
  user_email: "tamas.visegradi@gmail.com",
  message: orderContent,
  logos: `<table role="presentation" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">
      <table role="presentation" cellpadding="0" cellspacing="0">
        <tr>
          <td style="padding:0 12px;">
            <img src="https://cdn-icons-png.flaticon.com/512/3224/3224178.png" width="90" height="90" alt="">
          </td>
          <td style="padding:0 12px;">
            <img src="https://logoeps.com/wp-content/uploads/2013/04/pac-man-character-vector.png" width="90" height="90" alt="">
          </td>
          <td style="padding:0 12px;">
            <img src="https://purepng.com/public/uploads/thumbnail//purepng.com-mario-basedmariosuper-mariovideo-gamefictional-characternintendoshigeru-miyamotomario-franchise-1701528638226fbmbg.png" width="90" height="90" alt="">
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>`,
  system_type: "Order",
  email_heading: "Your Order",
  content_subtitle: "Content:",
};

const serviceID = "service_7grce58";
const templateID = "template_sqmrmho";

emailjs.send(serviceID, templateID, params);
