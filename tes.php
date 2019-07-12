<?php
/**
 * 依次从数组中取出数据，每取出一次下次最少要跳过N(N>=1)个数据，获取最大的总和
 */

echo '<pre/>';

class Jump{
    private $tongji;
    private $data;
    private $N;

    public function __construct($data, $N=1){
        $this->data = $data;
        $this->N = $N;

        $this->tongji = $this->getTongji($data,$N);
    }

    public function getTotal(){
        return $this->tongji[count($this->data)-1];
    }

    private function getTongji($data,$N){
        $tongji = [];

        foreach($data as $k=>$v){
            if(!$k){
                $tongji[$k] = $v;
                continue;
            }

            if($k <= $N){
                $tongji[$k] = max(max($tongji), $v);
                continue;
            }

            $count1 = $tongji[$k-$N-1] + $v;

            $counts = [];
            for($i=1;$i<=$N;$i++){
                array_push($counts,$tongji[$k-$i]);
            }
            $count2 = max($counts);

            $tongji[$k] = max($count1, $count2);
        }

        return $tongji;
    }
}

$data = [];
for($i=0;$i<10000;$i++){
    array_push($data,mt_rand(1,10));
}

$j = new Jump($data,2);

echo '[' . implode(",",$data) . ']';
echo "<br/>";
echo $j->getTotal();