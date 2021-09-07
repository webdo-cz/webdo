<?php

namespace App\Http\Livewire\Eshop;

use App\Models\Eshop\Order;
use App\Models\Eshop\OrderItem;
use App\Models\Eshop\OrderAddress;
use Livewire\WithPagination;
use Livewire\Component;

use SoapClient;
use SoapFault;

class Orders extends Component
{
    use WithPagination;

    public $order;
    public $cart;
    public $statuses = [
        'canceled',
        'waiting-for-payment',
        'waiting-for-packing',
        'packing',
        'waiting-for-send',
        'send',
        'delivered',
        'done'
    ];
    public $status;
    public $select = [];
    public $filter = [];
    public $filterForm = ['status'=>[]];

    public function submitPackageZasilkovna()
    {
        $gw = new SoapClient('http://www.zasilkovna.cz/api/soap.wsdl');
        $apiPassword = "3120a6b3c3b20d97392425ce88fa0991";

        try {
            $packet = $gw->createPacket($apiPassword, array(
                'number' => $this->order->payment_code,
                'name' => $this->order->address['delivery']->name ?? $this->order->address['order']->name,
                'surname' => $this->order->address['delivery']->surname ?? $this->order->address['order']->surname,
                'email' => $this->order->email,
                'phone' => $this->order->telephone,
                'addressId' => $this->order->shipment->name == 'doruceni-domu' ? 106 : $this->order->shipment_code,
                'street' => $this->order->address['delivery']->street ?? $this->order->address['order']->street,
                'houseNumber' => $this->order->address['delivery']->number ?? $this->order->address['order']->number,
                'city' => $this->order->address['delivery']->city ?? $this->order->address['order']->city,
                'zip' => $this->order->address['delivery']->post_code ?? $this->order->address['order']->post_code,
                'cod' => $this->order->payment->name == 'on-delivery' ? $this->order->total : 0,
                'value' => $this->order->total
            ));
        }
        catch(SoapFault $e) {
            return flashError([
                'title' => 'Chyba při podání!',
                'message' => 'Nepodařilo se podat zásilku, můžete to udělat ručně.',
            ], $this);
        }

        $this->order->status = 'packing';
        $this->order->save();
        $this->status = array_search('packing', $this->statuses);

        return flashSuccess([
            'title' => 'Zásilka úspěšně podána!',
            'message' => 'Zásilka byla úspěšně nahrána do databáze Zásilkovny.',
        ], $this);
    }

    public function submitFilter()
    {
        $this->filter = $this->filterForm;
        $this->resetPage();
    }

    public function showOrder($id)
    {
        $this->order = Order::find($id);
        $this->cart = OrderItem::where('order_id', $this->order->id)->get();
        $this->status = array_search($this->order->status, $this->statuses);
    }

    public function closeOrder()
    {
        $this->order = null;
    }

    public function changeMultipleStatus($status)
    {
        if(!empty($this->select)) {
            foreach($this->select as $id) {
                $order = Order::find($id);
                $order->status = $status;
                $order->save();
            }
            flashSuccess([
                'title' => 'Status změněn!',
                'message' => 'Statusy byly  objednávek úspěšně změněny.',
            ], $this);
            $this->select = [];
        }
    }

    public function changeStatus($status, $id)
    {
        $this->order->status = $status;
        $this->order->save();
        $this->status = $id;
    }

    public function mount()
    {
        
    }

    public function render()
    {
        $orders = Order::where('cart', '0');
        foreach($this->filter as $key => $filter) {
            if(!empty($filter)) {
                $orders = $orders->whereIn($key, $filter);
            }
        }
        $orders = $orders->orderBy('submited_at', 'desc')->paginate(25);
        return view('livewire.eshop.orders')->with('orders', $orders);
    }
}
