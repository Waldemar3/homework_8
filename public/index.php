<?php
interface ShawarmaInterface
{
    public function getCost(): float;

    public function getIngredients(): array;

    public function getTitle(): string;
}
class shawarmaOdessa implements ShawarmaInterface {
    public function getCost(): float
    {
        return 69;
    }

    public function getIngredients(): array
    {
        return explode(', ', 'огурцы маринованные, картофель жареный, чесночный соус, тандырный лаваш, маринованный лук с барбарисом и зеленью, мясо куриное, салат коул слоу, корейская морковь');
    }

    public function getTitle(): string
    {
        return 'Шаурма Одесская';
    }
}
class shawarmaBeef implements ShawarmaInterface {
    public function getCost(): float
    {
        return 75;
    }

    public function getIngredients(): array
    {
        return explode(', ', 'чесночный соус, говяжий окорок, огурцы маринованные, маринованный лук с барбарисом и зеленью, салат коул слоу, тандырный лаваш, помидоры свежие, хумус, соус тахин');
    }

    public function getTitle(): string
    {
        return 'Шаурма говяжья';
    }
}
class shawarmaMutton implements ShawarmaInterface {
    public function getCost(): float
    {
        return 85;
    }

    public function getIngredients(): array
    {
        return explode(', ', 'острый соус, огурцы маринованные, кинза, помидоры свежие, маринованный лук с барбарисом и зеленью, мясо баранины, лаваш арабский');
    }

    public function getTitle(): string
    {
        return 'Шаурма из Баранины';
    }
}
class ShawarmaCalculator{

    protected $listShawarma = [];

    public function __construct(ShawarmaInterface $shawarma)
    {
        $this->listShawarma[$shawarma->getTitle()] = $shawarma;
    }
    public function add(ShawarmaInterface $shawarma):void
    {
        foreach ($this->listShawarma as $sham){
            if($sham == $shawarma){
                throw new InvalidArgumentException('Данная шаурма уже находится в корзине');
            }
        }
        $this->listShawarma[$shawarma->getTitle()] = $shawarma;
    }
    public function ingredients():void
    {
       foreach ($this->listShawarma as $title => $sham){
           echo $title . "<br>";
           foreach($sham->getIngredients() as $ingredient){
               echo "<pre>" . $ingredient . "</pre>";
           }

       }
    }
    public function price():void
    {
        $sum = 0;
        foreach ($this->listShawarma as $sham){
            $sum += $sham->getCost();
        }
        echo 'К оплате: ' . $sum;
    }
}

$shawarma = new ShawarmaCalculator(new shawarmaOdessa());
$shawarma->add(new shawarmaBeef());
$shawarma->add(new shawarmaMutton());
$shawarma->ingredients();
$shawarma->price();

?>
