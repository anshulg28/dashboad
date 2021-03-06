<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * curl Library
 */
class curl_library
{
	public function getApiData($url, $time_out, $optHeaders)
	{
		$curl = curl_init();
		curl_setopt ($curl, CURLOPT_URL, $url);
		if($time_out != 0)
		{
			curl_setopt($curl, CURLOPT_TIMEOUT, $time_out);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		if($optHeaders != '')
		{
			curl_setopt($curl, CURLOPT_HTTPHEADER, $optHeaders);
		}
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec ($curl);
		curl_close ($curl);
        return $result;
	}

	public function getApiDataByPost($url, $data, $time_out, $optHeaders)
	{
		$curl = curl_init();
		curl_setopt ($curl, CURLOPT_URL, $url);
		if($time_out != 0)
		{
			curl_setopt($curl, CURLOPT_TIMEOUT, $time_out);
		}
		if($optHeaders != '')
		{
			curl_setopt($curl, CURLOPT_HTTPHEADER, $optHeaders);
		}
		curl_setopt($curl, CURLOPT_POST, true);  // tell curl you want to post something
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($curl);
		curl_close ($curl);
		return $result;
	}
    public function getApiJSONDataByPost($url, $data, $time_out, $optHeaders)
    {
        $curl = curl_init();
        curl_setopt ($curl, CURLOPT_URL, $url);
        if($time_out != 0)
        {
            curl_setopt($curl, CURLOPT_TIMEOUT, $time_out);
        }
        if($optHeaders != '')
        {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $optHeaders);
        }
        curl_setopt($curl, CURLOPT_POST, true);  // tell curl you want to post something
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close ($curl);
        return $result;
    }

    public function getApiDataByDelete($url, $data, $time_out, $optHeaders)
    {
        $curl = curl_init();
        curl_setopt ($curl, CURLOPT_URL, $url);
        if($time_out != 0)
        {
            curl_setopt($curl, CURLOPT_TIMEOUT, $time_out);
        }
        if($optHeaders != '')
        {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $optHeaders);
        }
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        //curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close ($curl);
        return $result;
    }

	private function getDataByGet($url, $timeOut = 0, $headers = '')
	{
		$detailsTemp = $this->getApiData($url, $timeOut, $headers);
		$details = json_decode($detailsTemp, true);
		return $details;
	}

	private function getDataByPost($url, $parameters, $timeOut = 0, $headers = '')
	{
		$detailsTemp = $this->getApiDataByPost($url, $parameters, $timeOut, $headers);
		$details = json_decode($detailsTemp, true);
		return $details;
	}

    private function getJSONDataByPost($url, $parameters, $timeOut = 0, $headers = '')
    {
        $detailsTemp = $this->getApiJSONDataByPost($url, $parameters, $timeOut, $headers);
        $details = json_decode($detailsTemp, true);
        return $details;
    }

    private function getDataByDelete($url, $parameters, $timeOut = 0, $headers = '')
    {
        $detailsTemp = $this->getApiDataByDelete($url, $parameters, $timeOut, $headers);
        $details = json_decode($detailsTemp, true);
        return $details;
    }
	/*public function banquetGetList($filters)
	{
		$url = API_BASE.'productbanquet/getList?'.http_build_query(array('bypass' => API_AUTH_TOKEN));
		return $this->getDataByPost($url, $filters);
	}*/

    public function getFacebookPosts($storeName,$params)
    {
        $url = FACEBOOK_API.$storeName.'/tagged?'.http_build_query($params);
        return $this->getDataByGet($url, 0);
    }
    public function getInstagramPosts()
    {
        $url = 'https://www.juicer.io/api/feeds/24816';
        return $this->getDataByGet($url, 0);
    }
    public function getMoreInstaFeeds()
    {
        $url = 'https://www.juicer.io/api/feeds/31761';
        return $this->getDataByGet($url, 0);
    }

    /* Instamojo API */

    public function getInstaImageLink()
    {
        $url = 'https://www.instamojo.com/api/1.1/links/get_file_upload_url/';
        $header = array(
            'X-Api-Key:'.INSTA_API_KEY,
            'X-Auth-Token:'.INSTA_AUTH_TOKEN
        );
        return $this->getDataByGet($url,0, $header);
    }
    public function uploadInstaImage($imgLink, $img)
    {
        $url = $imgLink;
        $header = array(
            'X-Api-Key:'.INSTA_API_KEY,
            'X-Auth-Token:'.INSTA_AUTH_TOKEN
        );
        //var_dump(base_url().EVENT_PATH_THUMB.$img);
        return $this->getDataByPost($url,array('url'=>MOBILE_URL.EVENT_PATH_THUMB.$img),0, $header);
    }
    public function createInstaLink($details)
    {
        $url = 'https://www.instamojo.com/api/1.1/links/';
        $header = array(
            'X-Api-Key:'.INSTA_API_KEY,
            'X-Auth-Token:'.INSTA_AUTH_TOKEN
        );
        //var_dump(base_url().EVENT_PATH_THUMB.$img);
        return $this->getDataByPost($url,$details,0, $header);
    }
    public function getInstaMojoRecord($payId)
    {
        $url = 'https://www.instamojo.com/api/1.1/payments/'.$payId.'/';
        $header = array(
            'X-Api-Key:'.INSTA_API_KEY,
            'X-Auth-Token:'.INSTA_AUTH_TOKEN
        );
        return $this->getDataByGet($url,0, $header);
    }

    public function refundInstaPayment($details)
    {
        $url = 'https://www.instamojo.com/api/1.1/refunds/';
        $header = array(
            'X-Api-Key:'.INSTA_API_KEY,
            'X-Auth-Token:'.INSTA_AUTH_TOKEN
        );
        return $this->getDataByPost($url,$details,0, $header);
    }

    public function archiveInstaLink($slug)
    {
        $url = 'https://www.instamojo.com/api/1.1/links/'.$slug.'/';
        $header = array(
            'X-Api-Key:'.INSTA_API_KEY,
            'X-Auth-Token:'.INSTA_AUTH_TOKEN
        );
        return $this->getDataByDelete($url,'',0,$header);
    }

    public function allRefundsInsta()
    {
        $url = 'https://www.instamojo.com/api/1.1/refunds/';
        $header = array(
            'X-Api-Key:'.INSTA_API_KEY,
            'X-Auth-Token:'.INSTA_AUTH_TOKEN
        );
        return $this->getDataByGet($url,0, $header);
    }

    public function getJukeboxTaprooms()
    {
        $url = 'http://api.bcjukebox.in/api/restaurants/';
        $header = array(
            'bcclientid:'.BCJUKEBOX_CLIENT,
        );
        return $this->getDataByGet($url,0, $header);
    }
    public function getTaproomInfo($id)
    {
        $url = 'http://api.bcjukebox.in/api/restaurants/'.$id.'/request_queue/';
        $header = array(
            'bcclientid:'.BCJUKEBOX_CLIENT,
        );
        return $this->getDataByGet($url,0, $header);
    }
    public function sendCouponSMS($details)
    {
        $url = 'http://api.textlocal.in/send/';

        return $this->getDataByPost($url,$details,0);
    }

    public function getSMSCredits($details)
    {
        $url = 'http://api.textlocal.in/balance/';

        return $this->getDataByPost($url,$details,0);
    }

    public function saveOlympicsMeta($details)
    {
        $url = 'http://beerolympics.in/meta_save/';

        return $this->getDataByPost($url,$details,0);
    }
    //EventsHigh Enable Event
    public function enableEventsHigh($eventsHighId)
    {
        $url = 'https://developer.eventshigh.com/enable_event/'.$eventsHighId.'?key='.EVENT_HIGH_KEY;
        return $this->getDataByGet($url,0, array());
    }
    //EventsHigh Disable Event
    public function disableEventsHigh($eventsHighId)
    {
        $url = 'https://developer.eventshigh.com/disable_event/'.$eventsHighId.'?key='.EVENT_HIGH_KEY;
        return $this->getDataByGet($url,0, array());
    }

    //EventsHigh Getting Attendee List
    public function attendeeEventsHigh($eventsHighId)
    {
        $url = 'https://developer.eventshigh.com/get_event_attendees/'.$eventsHighId.'?key='.EVENT_HIGH_KEY;
        return $this->getDataByGet($url,0, array());
    }
    public function refundEventsHigh($details)
    {
        $url = 'https://developer.eventshigh.com/refund_booking?key='.EVENT_HIGH_KEY;
        $headers = array(
            'Content-Type: application/json'
        );
        return $this->getJSONDataByPost($url,$details,0,$headers);
    }
    public function testmp3($details)
    {
        $url = 'https://www.ytbmp3.com/i/download';
        $headers = array(
            'Content-Type: application/json',
            'Origin: https://www.ytbmp3.com',
            'Cookie: secid=AXFYYWW34VSDKVGXYSYN5SCHEQ; _ga=GA1.2.1583980896.1510408278; _gid=GA1.2.151150225.1510408278',
            'x-secid: AXFYYWW34VSDKVGXYSYN5SCHEQ'
        );
        return $this->getJSONDataByPost($url,$details,0,$headers);
    }

    public function sendNewOTPSMS($params)
    {
        $url = 'http://api.msg91.com/api/sendhttp.php?'.http_build_query($params);
        return $this->getDataByGet($url, 0);
    }

    public function setTrigger($params)
    {
        $url = TRIGGER_API.'tasks/create?'.http_build_query($params);
        return $this->getDataByGet($url, 0);
    }

    public function getQuikchexAttendance($params)
    {
        $url = QUIKCHEX_API.'detailed_attendance_data?'.http_build_query($params);
        return $this->getDataByGet($url, 0);
    }
    public function checkBill($params)
    {
        $headers = array(
            'Content-Type: application/x-www-form-urlencoded',
        );
        $url = "https://live.nirvanaxp.com/report_view/extract?__report=order_details_report.rptdesign&__format=html&fromDate=2018-01-01&location_name=Doolally+Tap+Room+%28Banra%29&toDate=2018-01-02&businessId=1508&currentDate=2018-01-02+03%3A20%3A10&schemaName=doolally_613&order_id=43432&logoUrl=https%3A%2F%2Flive.nirvanaxp.com%2Fimages%2Flocation_images%2F120_120%2F1428568524_IMG20150409135203.jpg&locationCurrency=%24&__overwrite=true&__locale=en_US&__designer=false";
        return $this->getDataByPost($url,$params, 0,$headers);
    }
}