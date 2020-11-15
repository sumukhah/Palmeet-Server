<h1>Palmeet Endpoints and Responses</h1>
<h2>New Pal Request</h2>
<p>This endpoint is used to request for a new pal.&nbsp;</p>
<blockquote>127.0.0.1:8000/api/new-pal-request</blockquote>
<p>Takes Two Parameters in addition to the general Authorization: Bearer Token in the header:</p>
<p>email (required)</p>
<p>message (optional)</p>
<p>Example:</p>
<blockquote>127.0.0.1:8000/api/new-pal-request?email=hexxondiv@gmail.com&amp;message=Can we be friends</blockquote>
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
            <td style="width: 50.0000%;">User id of Sender</td>
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
<p>127.0.0.1:8000/api/accept-pal-request/{id}</p>
<p>Example</p>
<pre>127.0.0.1:8000/api/accept-pal-request/18</pre>
<p>Response:</p>
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
<p>, if you set up a local host URL. From here on. We assume you set up a local host URL instance palmeet.test.</p>
<p>Hence the Test Link for viewing list of pals is&nbsp;</p>
<pre>/api/pals</pre>
<p>Example:</p>
<pre>palmeet.test/api/pals</pre>
<h2>Result:</h2>
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
