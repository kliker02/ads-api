<?php


namespace Kliker02\VcruTask\Controllers;


use Kliker02\VcruTask\Model\Ad;
use Kliker02\VcruTask\Model\Ad\AdTable;
use Kliker02\VcruTask\Renderer\JsonRenderer;
use Kliker02\VcruTask\RouteParamsInterface;
use Kliker02\VcruTask\Validators\IsImageRemote;
use Laminas\Db\Sql\Select;
use Laminas\Http\Response;

/**
 * @author Alex Tokunov
 * Class AdsController
 * @package Kliker02\VcruTask\Controllers
 */
class AdsController extends AbstractController
{
    public function add()
    {
        $response = ['message' => '', 'code' => Response::STATUS_CODE_200, 'data' => null];

        if (!$this->getRequest()->isPost()) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_404);
            throw new \Exception('Invalid method');
        }

        $objAd = new Ad();
        $objAd->setText(trim(strval($this->getRequest()->getPost('text', ''))));
        $objAd->setPrice(abs(floatval($this->getRequest()->getPost('price', 0))));
        $objAd->setLimit(abs(intval($this->getRequest()->getPost('limit', 0))));
        $objAd->setBanner(trim(strval($this->getRequest()->getPost('banner', ''))));

        if (strlen($objAd->getText()) > 255 || strlen($objAd->getText()) == 0) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
            throw new \Exception('Invalid text provided');
        }

        if ($objAd->getPrice() <= 0.009) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
            throw new \Exception('Invalid price provided');
        }
        if ($objAd->getLimit() == 0) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
            throw new \Exception('Invalid limit provided');
        }

        if (filter_var($objAd->getBanner(), FILTER_VALIDATE_URL) === false) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
            throw new \Exception('Invalid banner provided');
        }

        $ImageRemoteValidator = new IsImageRemote($objAd->getBanner());
        if (!$ImageRemoteValidator->isValid()) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
            throw new \Exception('Invalid banner provided');
        }

        $sm = $this->getServiceManager();
        $tblAd = new AdTable($sm);
        $ok = $tblAd->insert(['Text' => $objAd->getText(), 'Price' => $objAd->getPrice(), 'Limit' => $objAd->getLimit(), 'Banner' => $objAd->getBanner()]);

        if (!$ok) {
            throw new \Exception('Happened something bad');
        } else {
            $objAd->setID($tblAd->getLastInsertValue());
        }

        $response['message'] = 'OK';
        $response['data'] = [
            'id' => $objAd->getID(),
            'text' => $objAd->getText(),
            'banner' => $objAd->getBanner(),
        ];
        return new JsonRenderer($response);
    }


    public function edit(RouteParamsInterface $RouteParams)
    {
        if (!$this->getRequest()->isPost()) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_404);
            throw new \Exception('Invalid method');
        }

        $response = ['message' => '', 'code' => Response::STATUS_CODE_200, 'data' => null];

        $id = intval($RouteParams->getParam('id'));

        $tblAd = new AdTable($this->getServiceManager());
        $row = $tblAd->get($id);
        if ($row === null) {
            throw new \Exception('Row has not been found by provided id');
        }

        $text = (trim(strval($this->getRequest()->getPost('text', $row->Text))));
        $price = (abs(floatval($this->getRequest()->getPost('price', $row->Price))));
        $limit = (abs(intval($this->getRequest()->getPost('limit', $row->Limit))));
        $banner = (trim(strval($this->getRequest()->getPost('banner', $row->Banner))));

        if (strlen($text) > 255 || strlen($text) == 0) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
            throw new \Exception('Invalid text provided');
        }

        if ($price <= 0.009) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
            throw new \Exception('Invalid price provided');
        }
        if ($limit <= $row->Shown) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
            throw new \Exception('Invalid limit provided');
        }

        if (filter_var($banner, FILTER_VALIDATE_URL) === false) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
            throw new \Exception('Invalid banner provided');
        }

        $ImageRemoteValidator = new IsImageRemote($banner);
        if (!$ImageRemoteValidator->isValid()) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_400);
            throw new \Exception('Invalid banner provided');
        }

        $tblAd->update(['Text' => $text, 'Price' => $price, 'Limit' => $limit, 'Banner' => $banner], ['id'=>$id]);

        $response['message'] = 'OK';
        $response['data'] = [
            'id' => $id,
            'text' => $text,
            'banner' => $banner,
        ];
        return new JsonRenderer($response);
    }


    /**
     * @author Alex Tokunov
     * Returns ads according to higher price
     * @param RouteParamsInterface $RouteParams
     * @return JsonRenderer
     */
    public function relevant(RouteParamsInterface $RouteParams)
    {
        $response = ['message' => '', 'code' => Response::STATUS_CODE_200, 'data' => null];

        $tblAd = new AdTable($this->getServiceManager());
        $row = $tblAd->getRelevant();
        if ($row != null) {
            $response['data'] = [
                'id' => $row->ID,
                'text' => $row->Text,
                'banner' => $row->Banner,
            ];
        }

        $tblAd->update(['Shown' => $row->Shown+1], ['id'=>$row->ID]);

        $tblView = new Ad\View\ViewTable($this->getServiceManager());
        $tblView->insert(['Price' => $row->Price, 'Ad_ID' => $row->ID]);

        $response['message'] = 'OK';
        return new JsonRenderer($response);
    }

}