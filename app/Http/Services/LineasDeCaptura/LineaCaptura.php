<?php

namespace App\Http\Services\LineasDeCaptura;

use App\Exceptions\ErrorAlGenerarLineaDeCaptura;
use App\Exceptions\ErrorAlValidarLineaDeCaptura;
use GuzzleHttp\Client;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LineaCaptura
{

    public $soapUser;
    public $soapPassword;
    public $tramite;
    public $servicio;

    public function __construct($tramite)
    {
        $this->soapUser = env('SAP_USUARIO');

        $this->soapPassword = env('SAP_CONTRASENA');

        $this->servicio = Servicio::find($tramite->id_servicio);

        $this->tramite = $tramite;
    }

    /* public function generarLineaDeCaptura(){

        $request =
        "
        <soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:ser=\"http://www.michoacan.gob.mx/ServGralLC\">
            <soapenv:Header/>
            <soapenv:Body>
            <ser:MT_ServGralLC_PI_Sender>
                <!--Optional:-->
                <ES_GEN_DATA>
                    <!--Optional:-->
                    <TP_PROCESAMIENTO>2</TP_PROCESAMIENTO>
                    <!--Optional:-->
                    <TP_DATOMAESTRO>E</TP_DATOMAESTRO>
                    <!--Optional:-->
                    <TP_DIVERSO>CATASTRO</TP_DIVERSO>
                    <!--Optional:-->
                    <RFC>XXXX0001XXX</RFC>
                    <!--Optional:-->
                    <NOMBRE_RAZON>". $this->tramite->nombre_solicitante ."</NOMBRE_RAZON>
                    <!--Optional:-->
                    <DOMICILIO>Conocido</DOMICILIO>
                </ES_GEN_DATA>
                <!--Zero or more repetitions:-->
                <TB_CONCEPTOS>
                    <!--Optional:-->
                    <TP_INGRESO>" . $this->servicio->clave_ingreso . "</TP_INGRESO>
                    <!--Optional:-->
                    <CANTIDAD>1</CANTIDAD>
                    <!--Optional:-->
                    <IMPORTE>" . $this->tramite->monto . "</IMPORTE>
                </TB_CONCEPTOS>
            </ser:MT_ServGralLC_PI_Sender>
            </soapenv:Body>
        </soapenv:Envelope>
        ";

        $headers = [
            'Method: POST',
            'Connection: Keep-Alive',
            'User-Agent: PHP-SOAP-CURL',
            'Content-Type: text/xml; charset=utf-8',
            'SOAPAction: "http://sap.com/xi/WebService/soap1.1"',
            'Host: gemnwpip.michoacan.gob.mx:52001',
        ];

        $response = Http::withHeaders($headers)->withOptions([
                                    'body' => $request,
                                    'headers' => $headers,
                                    'curl' => [
                                        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_HTTPHEADER => $headers,
                                        CURLOPT_POST => true,
                                        CURLOPT_USERPWD => $this->soapUser.":".$this->soapPassword,
                                        CURLOPT_POSTFIELDS => $request,
                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                        CURLOPT_SSL_VERIFYHOST => 0,
                                        CURLOPT_SSL_VERIFYPEER => 0,
                                    ]
                                ])->post('https://gemnwpip.michoacan.gob.mx:52001/XISOAPAdapter/MessageServlet?senderParty=&senderService=BS_WEB_PIP&receiverParty=&receiverService=&interface=SI_ServGralLC_PI_Sender&interfaceNamespace=http://www.michoacan.gob.mx/ServGralLC');

        dd($response);

    } */

    /* public function generarLineaDeCaptura(){

        $request =
        "
        <soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:ser=\"http://www.michoacan.gob.mx/ServGralLC\">
            <soapenv:Header/>
            <soapenv:Body>
            <ser:MT_ServGralLC_PI_Sender>
                <!--Optional:-->
                <ES_GEN_DATA>
                    <!--Optional:-->
                    <TP_PROCESAMIENTO>2</TP_PROCESAMIENTO>
                    <!--Optional:-->
                    <TP_DATOMAESTRO>E</TP_DATOMAESTRO>
                    <!--Optional:-->
                    <TP_DIVERSO>CATASTRO</TP_DIVERSO>
                    <!--Optional:-->
                    <RFC>XXXX0001XXX</RFC>
                    <!--Optional:-->
                    <NOMBRE_RAZON>". $this->tramite->nombre_solicitante ."</NOMBRE_RAZON>
                    <!--Optional:-->
                    <DOMICILIO>Conocido</DOMICILIO>
                </ES_GEN_DATA>
                <!--Zero or more repetitions:-->
                <TB_CONCEPTOS>
                    <!--Optional:-->
                    <TP_INGRESO>" . $this->servicio->clave_ingreso . "</TP_INGRESO>
                    <!--Optional:-->
                    <CANTIDAD>1</CANTIDAD>
                    <!--Optional:-->
                    <IMPORTE>" . $this->tramite->monto . "</IMPORTE>
                </TB_CONCEPTOS>
            </ser:MT_ServGralLC_PI_Sender>
            </soapenv:Body>
        </soapenv:Envelope>
        ";

        $headers = [
            'Method: POST',
            'Connection: Keep-Alive',
            'User-Agent: PHP-SOAP-CURL',
            'Content-Type: text/xml; charset=utf-8',
            'SOAPAction: "http://sap.com/xi/WebService/soap1.1"',
            'Host: gemnwpip.michoacan.gob.mx:52001',
        ];

        $ch = curl_init('https://gemnwpip.michoacan.gob.mx:52001/XISOAPAdapter/MessageServlet?senderParty=&senderService=BS_WEB_PIP&receiverParty=&receiverService=&interface=SI_ServGralLC_PI_Sender&interfaceNamespace=http://www.michoacan.gob.mx/ServGralLC');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->soapUser.":".$this->soapPassword);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);

        curl_close($ch);

        $error = curl_error($ch);

        if($error)
            throw new ErrorAlGenerarLineaDeCaptura('Error al generar linea de captura');

        $xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
        $xml = simplexml_load_string($xml);
        $json = json_encode($xml);
        $responseArray = json_decode($json,true);

        return $responseArray;

    } */

    public function generarLineaDeCaptura(){

        $request =
        "
        <soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:ser=\"http://www.michoacan.gob.mx/ServGralLC\">
            <soapenv:Header/>
            <soapenv:Body>
            <ser:MT_ServGralLC_PI_Sender>
                <!--Optional:-->
                <ES_GEN_DATA>
                    <!--Optional:-->
                    <TP_PROCESAMIENTO>2</TP_PROCESAMIENTO>
                    <!--Optional:-->
                    <TP_DATOMAESTRO>E</TP_DATOMAESTRO>
                    <!--Optional:-->
                    <TP_DIVERSO>DIRNOTAR</TP_DIVERSO>
                    <!--Optional:-->
                    <RFC>XXXX0001XXX</RFC>
                    <!--Optional:-->
                    <NOMBRE_RAZON>Prueba 1</NOMBRE_RAZON>
                    <!--Optional:-->
                    <DOMICILIO>Conocido</DOMICILIO>
                </ES_GEN_DATA>
                <!--Zero or more repetitions:-->
                <TB_CONCEPTOS>
                    <!--Optional:-->
                    <TP_INGRESO>D957</TP_INGRESO>
                    <!--Optional:-->
                    <CANTIDAD>1</CANTIDAD>
                    <!--Optional:-->
                    <IMPORTE>45</IMPORTE>
                </TB_CONCEPTOS>
            </ser:MT_ServGralLC_PI_Sender>
            </soapenv:Body>
        </soapenv:Envelope>
        ";

        $headers = [
            'Method: POST',
            'Connection: Keep-Alive',
            'User-Agent: PHP-SOAP-CURL',
            'Content-Type: text/xml; charset=utf-8',
            'SOAPAction: "http://sap.com/xi/WebService/soap1.1"',
            'Host: gemnwpiq.michoacan.gob.mx:51000',
        ];

        $ch = curl_init('http://gemnwpiq.michoacan.gob.mx:51000/XISOAPAdapter/MessageServlet?senderParty=&senderService=BS_WEB_PIQ&receiverParty=&receiverService=&interface=SI_ServGralLC_PI_Sender&interfaceNamespace=http://www.michoacan.gob.mx/ServGralLC');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->soapUser.":".$this->soapPassword);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

        $response = curl_exec($ch);

        curl_close($ch);

        $error = curl_error($ch);

        if($error)
            throw new ErrorAlGenerarLineaDeCaptura("Error al generar linea de captura. " . $error);


        $xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
        $xml = simplexml_load_string($xml);
        $json = json_encode($xml);
        $responseArray = json_decode($json,true);

        return $responseArray;

    }

    public function validarLineaDeCaptura(Request $r){

        $request =
        "
        <soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:val=\"http://www.michoacan.gob.mx/ValidarLinCaptura\">
            <soapenv:Header/>
            <soapenv:Body>
            <val:MT_ValidarLinCaptura_PI_Sender>
                <!--Optional:-->
                <TP_FOLIO>1</TP_FOLIO>
                <!--Optional:-->
                <FOLIO>" . $r->linea ."</FOLIO>
            </val:MT_ValidarLinCaptura_PI_Sender>
            </soapenv:Body>
        </soapenv:Envelope>
        ";

        $headers = [
            'Method: POST',
            'Connection: Keep-Alive',
            'User-Agent: PHP-SOAP-CURL',
            'Content-Type: text/xml; charset=utf-8',
            'SOAPAction: "http://sap.com/xi/WebService/soap1.1"',
            'Host: gemnwpip.michoacan.gob.mx:52000',
        ];

        $ch = curl_init('http://gemnwpip.michoacan.gob.mx:52000/XISOAPAdapter/MessageServlet?senderParty=&senderService=BS_WEB_PIP&receiverParty=&receiverService=&interface=SI_ValidarLinCaptura_PI_Sender&interfaceNamespace=http://www.michoacan.gob.mx/ValidarLinCaptura');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->soapUser.":".$this->soapPassword);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

        $response = curl_exec($ch);

        curl_close($ch);

        $error = curl_errno($ch);

        if($error)
            throw new ErrorAlValidarLineaDeCaptura("Error al validar linea de captura.");

        $xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
        $xml = simplexml_load_string($xml);
        $json = json_encode($xml);
        $responseArray = json_decode($json,true);

        return $responseArray;

    }

}
