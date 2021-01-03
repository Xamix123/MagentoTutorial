<?php

namespace Learning\CarTutorialOld\Controllers\Car;

use Exception;
use Learning\CarTutorialOld\Model\Car;
use Learning\CarTutorialOld\Model\ResourceModel\Car as CarResource;
use Learning\CarTutorialOld\Model\ResourceModel\Car\CollectionFactory;
use Learning\CarTutorialOld\Model\ResourceModel\CarFactory;
use Learning\Faq\Model\FaqRepository;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Add extends Action
{
    /**
     * @var Car
     */
    private $car;

    /**
     * @var CarResource
     */
    private $carResource;

    private $collectionFactory;

    private $carFactory;

    private $faqRepository;

    /**
     * Add constructor.
     * @param Context $context
     * @param Car $car
     * @param CarResource $carResource
     * @param CollectionFactory $collectionFactory
     * @param CarFactory $carFactory
     * @param FaqRepository $faqRepository
     */
    public function __construct(
        Context $context,
        Car $car,
        CarResource $carResource,
        CollectionFactory $collectionFactory,
        CarFactory $carFactory,
        FaqRepository $faqRepository
    ) {
        parent::__construct($context);
        $this->car = $car;
        $this->carResource = $carResource;
        $this->collectionFactory = $collectionFactory;
        $this->carFactory = $carFactory;
        $this->faqRepository = $faqRepository;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     */
    public function execute()
    {
        $data = ['manufacturer' => 'Ford', 'model' => 'Ford112'];

        /** service Contract try */
        echo 'Service Contract try : ';
        $faq = $this->faqRepository->getById('5');
        echo $faq->getTitle() . ' ';
        echo $faq->getContent();
        echo '<br>---------------------------------------------------------------<br>';

        $this->getSetTutorial();
        try {
            $carModel = $this->car;
            $carModel->setData($data);

            /* Use the resource model to save the model in the DB */
            $this->carResource->save($carModel);
            echo 'Car added Success. List Cars:';

            // Вариант вывода через getCollection
            // ---------------------------------------------------------------
            echo '<br>This is getCollection() method<br>';
            $collection = $this->car->getCollection();

            foreach ($collection as $item) {
                echo '<pre>';
                print_r($item->getData());
                echo '</pre>';
            }
            // ---------------------------------------------------------------

            echo '<br>---------------------------------------------------------------<br>';

            // Вариант с работой через Фабрику
            // ---------------------------------------------------------------
            echo 'Factory use method<br>';
            $collection = $this->collectionFactory->create();

            $collection->getSelect()->join(
                ['user_car'=>$collection->getTable('user_car')],
                'main_table.car_id = user_car.car_id',
                ['column1'=>'user_car.UName']
            );

            $collectionData = $collection->getItems();

            foreach ($collectionData as $item) {
                echo '<pre>';
                print_r($item->getData());
                echo '</pre>';
            }
            // ---------------------------------------------------------------
        } catch (Exception $exception) {
            echo 'Error ' . $exception->getCode() . ' ' . $exception->getMessage();
        }

        exit();
    }

    public function getSetTutorial()
    {
        $dataTest = [
            'name' => 'Example Test',
            'friends' => [
                'university' => [1, 2, 3, 4, 5],
                'home'  => [
                    'Petrov' => 1,
                    'Pupkin' => 2
                ]
            ]
        ];

        $this->getterAndSetterTest();
        $this->differentBetweenAddDataAndSetData($dataTest);
        $this->getDataAllAttributes($dataTest);
    }

    private function getterAndSetterTest()
    {
        $this->carFactory->create();
        $dataById = $this->car->load(5);

        $this->hasDataTest($dataById);
        $this->unsetDataTest($dataById);

        $dataById->setManufacturer('test123');
        var_export($dataById->toString());
        echo '<br>';

        $dataById->setData('model', 'newTestModel');
        var_export($dataById->toString());
        echo '<br>';

        echo (int)$dataById->getData('model'), '<br>';
    }

    private function getDataAllAttributes($data)
    {
//        echo 'getDataAllAttributes: <br>';
        $testGetSet = $this->car;
//        $testGetSet->setData($data);
//
//        /* no parameters */
//        $getData = $testGetSet->getData();
//        echo 'allData:';
//        var_export($getData);
//        echo '<br>';
//
//        $getDataParameter = $testGetSet->getData('name');
//        echo 'GetData By Key: ';
//        echo $getDataParameter . '<br>';
//
//        $getPathParameter = $testGetSet->getData('friends/home');
//        echo 'getData By path(`friends\home`): ';
//        var_export($getPathParameter);
//        echo '<br>';
//
//        $getDataParameterWithIndex = $testGetSet->getData('friends', 'university');
//        echo 'GetData By Key(friends) and Index(university): ';
//        var_export($getDataParameterWithIndex);
//        echo '<br>';
//
//        $getPathParameterIndex = $testGetSet->getData('friends/home', 'Petrov');
//        echo 'getData By path(`friends\home`) with index(Petrov): ';
//        var_export($getPathParameterIndex);
//        echo '<br>';
//
//        echo 'Our data is string:';
//
//        $testGetSet->unsetData();
//
//        $data = "test\ndata\nabc";
//
//        $testGetSet->setData([
//            '1'=>$data
//        ]);
//
//        $dataString = $testGetSet->getData('1', 1);
//        echo 'testData: ' . $dataString . '<br>';
//        $testGetSet->unsetData();

        $data1 = $this->car;

        $testGetSet->setData([1 => $data1]);

        $data1->setData(["1" => "i am find you"]);

        $testGetSet->getData("1", "1");

        echo 'Our data is DataObject:';

        echo '<br>';

//        $data = [
//            1 => [
//                1 => 2 ,
//                2 => 3 ,
//                3 => 4
//            ] ,
//            2 => [
//                1 => 1 ,
//                3 => 2
//            ]
//        ];
//
//        $testGetSet->setData($data);
//
//        $testGetSet->setData('abc/1', 5);

        var_export($testGetSet->getData());

        echo '<br>';

        echo '________________________________________________________<br>';
    }

    private function hasDataTest($dataTest)
    {
        $status = $dataTest->hasTestData();
        $statusHasData = $dataTest->hasData('testData');
        echo 'dataById hasTestData when field does not exist : ';
        var_export($status);
        echo '  hasData =>';
        var_export($statusHasData);
        echo '<br>';

        $dataTest->setTestData('1');

        $status = $dataTest->hasTestData();
        $statusHasData = $dataTest->hasData('test_data');

        echo 'dataById hasTestData when field exist: ';
        var_export($status);
        echo '  hasData =>';
        var_export($statusHasData);
        echo '<br>';
    }

    private function unsetDataTest($dataTest)
    {
        $dataUnsetTest = $dataTest;
        echo '________________________________________________________<br>';
        echo 'dataTest before unset:<br>';
        var_export($dataTest->toArray());
        echo '<br>';

        $dataTest->unsTestData();
        $dataUnsetTest->unsetData('test_data');
        echo 'dataTest after unset:<br>';
        var_export($dataTest->toArray());
        echo '<br>';
        var_export($dataUnsetTest->toArray());
        echo '<br>';
        echo '________________________________________________________<br>';
    }

    private function differentBetweenAddDataAndSetData($dataTest)
    {
        echo 'Different between addData and setData<br>';

        $testDifferent = $this->car;

        $testDifferent->setData($dataTest);
        echo '<br>Default data:<br>';
        var_export($testDifferent->getData());
        echo '<br>________________________________________________________<br>';

        echo 'AddData Test k3 => v3<br>';
        $testDifferent->addData(['k3' => 'v3']);
        var_export($testDifferent->getData());
        echo '<br>________________________________________________________<br>';

        echo 'SetData Test k25 => v25<br>';
        $testDifferent->setData(['k25' => 'v25']);
        var_export($testDifferent->getData());
        echo '<br>________________________________________________________<br>';
    }
}
