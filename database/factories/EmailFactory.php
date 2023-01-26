<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'message_id' => md5(10).'@marex.pl',
            'headers_raw' => 'Return-Path: <wykrojniki@uds.com.pl>
Received: from localhost (127.0.0.1) (HELO v097.home.net.pl)
 by /usr/run/smtp (/usr/run/postfix/private/idea_relay_lmtp) via UNIX with SMTP (IdeaSmtpServer 5.1.0)
 id 2103c1c135095948; Tue, 24 Jan 2023 12:49:48 +0100
Received: from cloudserver042882.home.pl (cloudserver042882.home.pl [89.161.216.210])
	(using TLSv1.3 with cipher TLS_AES_256_GCM_SHA384 (256/256 bits)
	 key-exchange ECDHE (P-256) server-signature RSA-PSS (2048 bits) server-digest SHA256)
	(No client certificate requested)
	by v097.home.net.pl (Postfix) with ESMTPS id 7733AEB03C6;
	Tue, 24 Jan 2023 12:49:47 +0100 (CET)
Authentication-Results: v097.home.net.pl; dmarc=none (p=none dis=none) header.from=uds.com.pl
Authentication-Results: v097.home.net.pl; spf=pass smtp.mailfrom=uds.com.pl
Received: from localhost (127.0.0.1) (HELO v168.home.net.pl)
 by /usr/run/smtp (/usr/run/postfix/private/idea_relay_lmtp) via UNIX with SMTP (IdeaSmtpServer 5.1.0)
 id 26a5c23c17dbd448; Tue, 24 Jan 2023 12:49:47 +0100
Received: from UDSNKWYK120 (109-206-202-10.host.skynet.net.pl [109.206.202.10])
	by v168.home.net.pl (Postfix) with ESMTPA id AB2E13FF0B9B;
	Tue, 24 Jan 2023 12:49:46 +0100 (CET)
From: "Wykrojniki UDS" <wykrojniki@uds.com.pl>
To: <serwis@perfect-cut.pl>,
	<kontakt@perfect-cut.pl>
Subject: zam44_0861_23
Date: Tue, 24 Jan 2023 12:49:46 +0100
Message-ID: <003201d92fe9$f4e6eb80$deb4c280$@uds.com.pl>
MIME-Version: 1.0
Content-Type: multipart/mixed;
	boundary="----=_NextPart_000_0033_01D92FF2.56ACDA20"
X-Mailer: Microsoft Outlook 15.0
Thread-Index: Adkv6fQRq8umvTzRSGueSWSgRbu1Vw==
Content-Language: pl
X-CLIENT-IP: 109.206.202.10
X-CLIENT-HOSTNAME: 109-206-202-10.host.skynet.net.pl
X-VADE-SPAMSTATE: clean
X-VADE-SPAMCAUSE: gggruggvucftvghtrhhoucdtuddrgedvhedruddvtddgvdekucetufdoteggodetrfdotffvucfrrhhofhhilhgvmecujffqoffgrffnpdggtffipffknecuuegrihhlohhuthemucduhedtnecunecujfgurhephffvufffkfggtgfothesmhdtghepvddthhenucfhrhhomhepfdghhihkrhhojhhnihhkihcufgffufdfuceofiihkhhrohhjnhhikhhisehuughsrdgtohhmrdhplheqnecuggftrfgrthhtvghrnhepvdevhfevleevheekveetteffheevteekkefhveefvdeigfejtddtfefggfefudfgnecuffhomhgrihhnpeihohhuthhusggvrdgtohhmpdhlihhnkhgvughinhdrtghomhdpuhgushdrtghomhdrphhlnecukfhppedutdelrddvtdeirddvtddvrddutdenucevlhhushhtvghrufhiiigvpedtnecurfgrrhgrmhepihhnvghtpedutdelrddvtdeirddvtddvrddutddphhgvlhhopegffffupffmhggjmfduvddtpdhmrghilhhfrhhomhepfdghhihkrhhojhhnihhkihcufgffufdfuceofiihkhhrohhjnhhikhhisehuughsrdgtohhmrdhplheqpdhnsggprhgtphhtthhopedvpdhrtghpthhtohepkhhonhhtrghkthesphgvrhhfvggtthdqtghuthdrphhlpdhrtghpthhtohepshgvrhifihhssehpvghrfhgvtghtqdgtuhhtrdhplh
X-CLIENT-IP: 89.161.216.210
X-CLIENT-HOSTNAME: cloudserver042882.home.pl
X-VADE-SPAMSTATE: clean
X-VADE-SPAMCAUSE: gggruggvucftvghtrhhoucdtuddrgedvhedruddvtddgvdekucetufdoteggodetrfdotffvucfrrhhofhhilhgvmecujffqoffgrffnpdggtffipffknecuuegrihhlohhuthemucduhedtnecunecujfgurhephffvufffkfggtgfothesmhdtghepvddthhenucfhrhhomhepfdghhihkrhhojhhnihhkihcufgffufdfuceofiihkhhrohhjnhhikhhisehuughsrdgtohhmrdhplheqnecuggftrfgrthhtvghrnhepvdevhfevleevheekveetteffheevteekkefhveefvdeigfejtddtfefggfefudfgnecuffhomhgrihhnpeihohhuthhusggvrdgtohhmpdhlihhnkhgvughinhdrtghomhdpuhgushdrtghomhdrphhlnecukfhppeekledrudeiuddrvdduiedrvddutddpuddtledrvddtiedrvddtvddruddtnecuvehluhhsthgvrhfuihiivgeptdenucfrrghrrghmpehinhgvthepkeelrdduiedurddvudeirddvuddtpdhhvghloheptghlohhuughsvghrvhgvrhdtgedvkeekvddrhhhomhgvrdhplhdpmhgrihhlfhhrohhmpedfhgihkhhrohhjnhhikhhiucgffffufdcuoeifhihkrhhojhhnihhkihesuhgushdrtghomhdrphhlqedpnhgspghrtghpthhtohepvddprhgtphhtthhopehkohhnthgrkhhtsehpvghrfhgvtghtqdgtuhhtrdhplhdprhgtphhtthhopehsvghrfihishesphgvrhhfvggtthdqtghuthdrphhl
X-DCC--Metrics: v097.home.net.pl 1024; Body=4 Fuz1=4 Fuz2=4
',
            'headers' => '[{"date":"Tue, 24 Jan 2023 12:49:46 +0100","Date":"Tue, 24 Jan 2023 12:49:46 +0100","subject":"zam44_0861_23","Subject":"zam44_0861_23","message_id":"<003201d92fe9$f4e6eb80$deb4c280$@uds.com.pl>","toaddress":"serwis@perfect-cut.pl, kontakt@perfect-cut.pl","to":[{"mailbox":"serwis","host":"perfect-cut.pl"},{"mailbox":"kontakt","host":"perfect-cut.pl"}],"fromaddress":"Wykrojniki UDS <wykrojniki@uds.com.pl>","from":[{"personal":"Wykrojniki UDS","mailbox":"wykrojniki","host":"uds.com.pl"}],"reply_toaddress":"Wykrojniki UDS <wykrojniki@uds.com.pl>","reply_to":[{"personal":"Wykrojniki UDS","mailbox":"wykrojniki","host":"uds.com.pl"}],"senderaddress":"Wykrojniki UDS <wykrojniki@uds.com.pl>","sender":[{"personal":"Wykrojniki UDS","mailbox":"wykrojniki","host":"uds.com.pl"}]',
            'from_name' => $this->faker->name($gender = 'male' | 'female'),
            'from_address' => $this->faker->companyEmail(),
            'subject' => $this->faker->sentence(2),
            'to' => "serwis@perfect-cut.pl",
            'to_string' => "serwis@perfect-cut.pl",
            'cc' => 'dostawy@marex.pl',
            'bcc' => 'serwis@perfect-cut.pl',
            'text_plain' => $this->faker->sentence(30),
            'text_html' => '<div id="card_2" class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Card 2</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">

                    <div class="row">

                        <div class="col-xxl-8 col-xl-12 col-lg-12 col-md-12 col-sm-8 mx-auto">
                    
                            <div class="card bg-secondary">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="mb-0">This is some text within a card body.</p>
                                </div>
                            </div>
                            
                        </div>

                    </div>

                    <div class="code-section-container">
                                
                        <button class="btn toggle-code-snippet"><span>Code</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down toggle-code-icon"><polyline points="6 9 12 15 18 9"></polyline></svg></button>

                        <div class="code-section text-left">
                        </div>
                    </div>

                </div>
            </div>
        </div>',
            'user_id' => 1, 

            'date'=> $this->faker->date(),
            'emailstatus' => "przeczytany",
        ];
    }
}
