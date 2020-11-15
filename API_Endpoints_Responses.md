<h1>Palmeet Endpoints and Responses</h1>
<h2>New Pal Request</h2>
<p>This endpoint is used to request for a meet pal.&nbsp;</p>
<blockquote>
    <pre><span style="color: rgb(250, 197, 28);">POST</span>: 127.0.0.1:8000/api/new-pal-request</pre>
</blockquote>
<p>Takes Two Parameters in addition to the general Authorization: Bearer token in the header:</p>
<p>email (required)</p>
<p>message (optional)</p>
<p>Example:</p>
<blockquote><span style="color: rgb(250, 197, 28);">POST</span>: 127.0.0.1:8000/api/new-pal-request?email=hexxondiv@gmail.com&amp;message=Can we be friends</blockquote>
<p>This sends a Pal request to the email address.</p>
<p>Where the email address already exists, a pal_id is embedded to the request, and the email is personalized.</p>
<p>Response:</p>
<pre>{
    &quot;data&quot;: {
        &quot;user_id&quot;: 12,
        &quot;email&quot;: &quot;hexxondiv@gmail.com&quot;,
        &quot;pal_id&quot;: 13,
        &quot;message&quot;: &quot;Can we be friends&quot;,
        &quot;updated_at&quot;: &quot;2020-11-14T14:47:52.000000Z&quot;,
        &quot;created_at&quot;: &quot;2020-11-14T14:47:52.000000Z&quot;,
        &quot;id&quot;: 18
    }
}</pre>
<table style="width: 100%;">
    <tbody>
        <tr>
            <td style="width: 50.0000%;">user_id</td>
            <td style="width: 50.0000%;">User ** of Sender</td>
        </tr>
        <tr>
            <td style="width: 50.0000%;">pal_id</td>
            <td style="width: 50.0000%;">User ID of Receiver</td>
        </tr>
        <tr>
            <td style="width: 50.0000%;">message</td>
            <td style="width: 50.0000%;">Any included text, just like in linkedIn</td>
        </tr>
        <tr>
            <td style="width: 50.0000%;">email</td>
            <td style="width: 50.0000%;">email of Receiver</td>
        </tr>
        <tr>
            <td style="width: 50.0000%;">id</td>
            <td style="width: 50.0000%;">Auto-Generated identifier for the request. This is sent as a parameter during Acceptance of request</td>
        </tr>
    </tbody>
</table>
<h2>Accept Pal Request (In-app)</h2>
<p>To Accept a Request, One can click the action button in the request mail, or simply open the app and from the list of Pending Pal Requests, Click &nbsp;accept button on any of them</p>
<p>The URL to effect acceptance is</p>
<pre>127.0.0.1:8000/api/accept-pal-request/{id}</pre>
<h4>Example</h4>
<pre><span style='font-family: "Times New Roman"; font-size: medium; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; color: rgb(65, 168, 95);'>GET:</span><span style='color: rgb(0, 0, 0); font-family: "Times New Roman"; font-size: medium; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;'> </span>127.0.0.1:8000/api/accept-pal-request/18</pre>
<h4>Response:</h4>
<pre>{
    &quot;success&quot;: &quot;Accepted&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 18,
        &quot;user_id&quot;: 12,
        &quot;email&quot;: &quot;hexxondiv@gmail.com&quot;,
        &quot;pal_id&quot;: 13,
        &quot;status&quot;: 1,
        &quot;message&quot;: &quot;Can we be friends&quot;,
        &quot;created_at&quot;: &quot;2020-11-14T14:47:52.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2020-11-14T14:52:07.000000Z&quot;,
        &quot;user&quot;: {
            &quot;id&quot;: 12,
            &quot;name&quot;: &quot;James Ochuwa&quot;,
            &quot;email&quot;: &quot;jamesochuwa@gmail.com&quot;,
            &quot;email_verified_at&quot;: null,
            &quot;created_at&quot;: &quot;2020-11-13T17:16:51.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2020-11-13T17:45:29.000000Z&quot;,
            &quot;api_token&quot;: &quot;lEdIsE1uuqFv50EChi4J430JHv3klWwHs1BXyUZHdCGaKtdQ10ALjHBORxKx&quot;
        }
    }
}

</pre>
<h2>Viewing Pal List</h2>
<p>To view list of <strong>Pals</strong> (Contacts)</p>
<p>Your APP_URL can be <span style="font-family: Tahoma,Geneva, sans-serif;">127.0.0.1:8000</span> if you hosted your app with php artisan serve. It can also be</p>
<pre>palmeet.test</pre>
<p>, if you set up a Local host URL. From here on. We assume you set up a local Host URL instance palmeet.test.</p>
<p>Hence the Test Link for viewing list ** pals is&nbsp;</p>
<pre>/api/pals</pre>
<h4>Example:</h4>
<pre><span style="color: rgb(65, 168, 95);">GET</span>: palmeet.test/api/pals</pre>
<h4>Result:</h4>
<pre>{
    &quot;data&quot;: {
        &quot;pending&quot;: [],
        &quot;rejected&quot;: [],
        &quot;my_pals&quot;: [
            {
                &quot;id&quot;: 13,
                &quot;user_id&quot;: 12,
                &quot;email&quot;: &quot;hexxondiv@gmail.com&quot;,
                &quot;pal_id&quot;: 1,
                &quot;status&quot;: 1,
                &quot;message&quot;: &quot;Can we be friends&quot;,
                &quot;created_at&quot;: &quot;2020-11-14T23:52:40.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2020-11-14T23:53:54.000000Z&quot;,
                &quot;pal&quot;: {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;James Nnanyelugo&quot;,
                    &quot;email&quot;: &quot;hexxondiv@gmail.com&quot;,
                    &quot;email_verified_at&quot;: null,
                    &quot;created_at&quot;: &quot;2020-11-14T23:35:41.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2020-11-14T23:47:25.000000Z&quot;,
                    &quot;api_token&quot;: &quot;faGxFGkia8pZxdajL2H8nW4gNbvVWzR3divbpHqmOcDo0VKe6hN98i60eGvp&quot;
                }
            }
        ],
        &quot;my_pending&quot;: []
    }
}</pre>
<h2>Viewing My Profile</h2>
<h4>Endpoint:</h4>
<pre><span style="color: rgb(65, 168, 95);">GET</span>: palmeet.test/api/profile</pre>
<h3>Response</h3>
<pre>{
    &quot;data&quot;: {
        &quot;id&quot;: 12,
        &quot;name&quot;: &quot;James Rufus&quot;,
        &quot;email&quot;: &quot;jamesochuwa@gmail.com&quot;,
        &quot;email_verified_at&quot;: null,
        &quot;created_at&quot;: &quot;2020-11-14T23:52:08.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2020-11-14T23:52:26.000000Z&quot;,
        &quot;api_token&quot;: &quot;FvOeV46dSNykDvlO57jg4yQxO5v8RT4SJJFCihtJJtrOEpF595T7jfWCzUtw&quot;
    }
}</pre>
<h1>MEETINGS</h1>
<h2>Creating a New Meeting:</h2>
<h4>Endpoint:&nbsp;</h4>
<pre>palmeet.test/api/meeting-new</pre>
<h4>Parameters</h4>
<table style="width: 100%;">
    <tbody>
        <tr>
            <td style="width: 33.2946%;">PARAMETER</td>
            <td style="width: 33.2946%;">DESCRIPTION</td>
            <td style="width: 33.3333%;">***** **** (REQUIRED)</td>
        </tr>
        <tr>
            <td style="width: 33.2946%;">title</td>
            <td style="width: 33.2946%;">Meeting title</td>
            <td style="width: 33.3333%;">string (*)</td>
        </tr>
        <tr>
            <td style="width: 33.2946%;">invitation</td>
            <td style="width: 33.2946%;">Meeting description</td>
            <td style="width: 33.3333%;">textarea ()</td>
        </tr>
        <tr>
            <td style="width: 33.2946%;">link</td>
            <td style="width: 33.2946%;">Meeting Link</td>
            <td style="width: 33.3333%;">url (*)</td>
        </tr>
        <tr>
            <td style="width: 33.2946%;">meeting_starts</td>
            <td style="width: 33.2946%;">Start time for the meeting</td>
            <td style="width: 33.3333%;">datetime YYYY-MM-** HH:MM:SS (*)</td>
        </tr>
        <tr>
            <td style="width: 33.2946%;">meeting_ends</td>
            <td style="width: 33.2946%;">End time *** the meeting</td>
            <td style="width: 33.3333%;">******** YYYY-MM-DD HH:MM:** (*)</td>
        </tr>
        <tr>
            <td style="width: 33.2946%;">meeting_id</td>
            <td style="width: 33.2946%;">Meeting **** ID&nbsp;</td>
            <td style="width: 33.3333%;">string ()</td>
        </tr>
        <tr>
            <td style="width: 33.2946%;">meeting_password</td>
            <td style="width: 33.2946%;">Meeting Password</td>
            <td style="width: 33.3333%;">string ()</td>
        </tr>
    </tbody>
</table>
<h4>Example</h4>
<pre><span style="color: rgb(250, 197, 28);">POST</span>: palmeet.test/api/meeting-new?title=Final Discussion on Integration&amp;invitation=Invitation Description&amp;link=https://meet.jit.si/EducareAccountsDevTeam&amp;meeting_starts=2020-11-15 22:00:00&amp;meeting_ends=2020-11-15 23:30:00</pre>
<h4>Response&nbsp;</h4>
<pre>{
    &quot;data&quot;: {
        &quot;user_id&quot;: 12,
        &quot;title&quot;: &quot;Final Discussion on Integration&quot;,
        &quot;invitation&quot;: &quot;Invitation Description&quot;,
        &quot;link&quot;: &quot;https://meet.jit.si/EducareAccountsDevTeam&quot;,
        &quot;meeting_starts&quot;: &quot;2020-11-15 22:00:00&quot;,
        &quot;meeting_ends&quot;: &quot;2020-11-15 23:30:00&quot;,
        &quot;updated_at&quot;: &quot;2020-11-15T08:13:16.000000Z&quot;,
        &quot;created_at&quot;: &quot;2020-11-15T08:13:16.000000Z&quot;,
        &quot;id&quot;: 14
    }
}</pre>
<p><br></p>
<h3>Inviting Pal(s) to my Meeting</h3>
<h4>Endpoint</h4>
<pre>palmeet.test/api/meeting-invite</pre>
<h4>Parameters</h4>
<table style="width: 100%;">
    <thead>
        <tr>
            <th>PARAMETER</th>
            <th>TYPE</th>
            <th>DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="width: 33.3333%;">meeting_id</td>
            <td style="width: 33.3333%;">As returned During Meeting creation</td>
            <td style="width: 33.3333%;">int</td>
        </tr>
        <tr>
            <td style="width: 33.3333%;">invitees</td>
            <td style="width: 33.3333%;">IDs of pals you want to invite</td>
            <td style="width: 33.3333%;">json_stringified ARRAY (eg &apos;[1,3,8]&apos;)</td>
        </tr>
    </tbody>
</table>
<h4>Example:</h4>
<pre><span style="color: rgb(250, 197, 28);">POST</span>: palmeet.test/api/meeting-invite?meeting_id=13&amp;invitees=[1,3,8]</pre>
<h4>Response</h4>
<pre>{
    &quot;success&quot;: &quot;successfully invited 3 Pals!&quot;
}</pre>
<p><br></p>
<h3>My Pending Meeting Invitation List</h3>
<h4>Endpoint</h4>
<pre><span style="color: rgb(65, 168, 95);">GET</span>: palmeet.test/api/my-meeting-invites</pre>
<h4>Response</h4>
<pre>{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;meeting_id&quot;: 13,
            &quot;user_id&quot;: 1,
            &quot;acceptance_status&quot;: 0,
            &quot;meeting_status&quot;: 0,
            &quot;created_at&quot;: &quot;2020-11-14T23:57:25.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2020-11-15T00:22:29.000000Z&quot;,
            &quot;meeting&quot;: {
                &quot;id&quot;: 13,
                &quot;user_id&quot;: 12,
                &quot;title&quot;: &quot;Final Discussion on Integration&quot;,
                &quot;invitation&quot;: &quot;Invitation Description&quot;,
                &quot;link&quot;: &quot;https://meet.jit.si/EducareAccountsDevTeam&quot;,
                &quot;meeting_id&quot;: null,
                &quot;meeting_password&quot;: null,
                &quot;meeting_starts&quot;: &quot;2020-11-15 22:00:00&quot;,
                &quot;meeting_ends&quot;: &quot;2020-11-15 23:30:00&quot;,
                &quot;status&quot;: 0,
                &quot;created_at&quot;: &quot;2020-11-15T08:13:16.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2020-11-15T08:13:16.000000Z&quot;,
                &quot;host&quot;: {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;James Rufus&quot;,
                    &quot;email&quot;: &quot;jamesochuwa@gmail.com&quot;
                }
            }
        }
    ]
}</pre>
<h3>Accepting a Meeting invite</h3>
<h4>Endpoint</h4>
<pre><span style="color: rgb(65, 168, 95);">GET</span>: palmeet.test/api/meeting-invite-accept/{invitation_id}</pre>
<h4>Example</h4>
<pre><span style="color: rgb(65, 168, 95);">GET</span>: palmeet.test/api/meeting-invite-accept/1</pre>
<h4>Response</h4>
<pre>{
    &quot;success&quot;: &quot;Acceptance Acknowledged&quot;
}</pre>
<h3><br></h3>
<h3>Declining a Meeting Invite</h3>
<h4>Endpoint&nbsp;</h4>
<pre>palmeet.test/api/meeting-invite-decline/{invitation_id}</pre>
<h4>Example</h4>
<pre><span style="color: rgb(65, 168, 95);">GET</span>: palmeet.test/api/meeting-invite-decline/1</pre>
<h4>Response</h4>
<pre>{
    &quot;success&quot;: &quot;Declination Acknowledged&quot;
}</pre>
<h3>Deleting a Meeting instance.</h3>
<p>This deletes Requests of the ******* too.</p>
<h4>Endpoint</h4>
<pre><span style="color: rgb(65, 168, 95);">GET</span>: palmeet.test/api/meeting-delete/{meeting_id}</pre>
<h4>Example</h4>
<pre><span style="color: rgb(65, 168, 95);">GET</span>: palmeet.test/api/meeting-delete/14</pre>
<h4>Response</h4>
<pre>{&quot;success&quot;:&quot;deleted!&quot;}</pre>
<p><br></p>
<p>Thanks!</p>
