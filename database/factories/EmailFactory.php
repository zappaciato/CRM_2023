<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Contact;
use Illuminate\Support\Facades\Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Email>
 */
class EmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

      $email = Contact::select('email')->get();
        // Log::debug($email[1]->email);
        return [
            'message_id' => md5(4).'@marex.pl',
            'headers_raw' => 'header_row_007',
            'headers' => '[{"date":"Tue, 24 Jan 2023 12:49:46 +0100","Date":"Tue, 24 Jan 2023 12:49:46 +0100","subject":"zam44_0861_23","Subject":"zam44_0861_23","message_id":"<003201d92fe9$f4e6eb80$deb4c280$@uds.com.pl>","toaddress":"serwis@perfect-cut.pl, kontakt@perfect-cut.pl","to":[{"mailbox":"serwis","host":"perfect-cut.pl"},{"mailbox":"kontakt","host":"perfect-cut.pl"}],"fromaddress":"Wykrojniki UDS <wykrojniki@uds.com.pl>","from":[{"personal":"Wykrojniki UDS","mailbox":"wykrojniki","host":"uds.com.pl"}],"reply_toaddress":"Wykrojniki UDS <wykrojniki@uds.com.pl>","reply_to":[{"personal":"Wykrojniki UDS","mailbox":"wykrojniki","host":"uds.com.pl"}],"senderaddress":"Wykrojniki UDS <wykrojniki@uds.com.pl>","sender":[{"personal":"Wykrojniki UDS","mailbox":"wykrojniki","host":"uds.com.pl"}]',
            'from_name' => $this->faker->name($gender = 'male' | 'female'),
            'from_address' => $email[count($email)-1]->email,
            'subject' => $this->faker->sentence(2),
            'to' => "serwis@perfect-cut.pl",
            'to_string' => "serwis@perfect-cut.pl",
            'cc' => 'dostawy@marex.pl',
            'bcc' => 'serwis@perfect-cut.pl',
            'text_plain' => $this->faker->sentence(30),
            'text_html' => ' <span class="preheader">This is preheader text. Some clients will show this text as a preview.</span>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">

            <!-- START CENTERED WHITE CONTAINER -->
            <table role="presentation" class="main">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <p>Hi there,</p>
                        <p>Sometimes you just want to send a simple HTML email with a simple design and clear call to action. This is it.</p>
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                          <tbody>
                            <tr>
                              <td align="left">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                  <tbody>
                                    <tr>
                                      
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <p>This is a really simple email template. Its sole purpose is to get the recipient to click the button with no distractions.</p>
                        <p>Good luck! Hope it works.</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>
            <!-- END CENTERED WHITE CONTAINER -->

            <!-- START FOOTER -->
            <div class="footer">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-block">
                    <span class="apple-link">Company Inc, 3 Abbey Road, San Francisco CA 94102</span>
                    ',
            'user_id' => 1, 

            'date'=> $this->faker->date(),
            'emailstatus' => "przeczytany",
        ];
    }
}
