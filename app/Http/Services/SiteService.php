<?php

namespace app\Http\Services;

use App\Model\Dish;
use App\Model\Restaurant;
use App\Model\Comment;
use App\Model\AddRestaurant;
use App\Model\Menu;

class SiteService
{
	protected $dishModel;

	protected $restaurantModel;

	protected $commentModel;

	protected $addRestaurantModel;

	protected $menuModel;

	public function __construct(Dish $dishModel, Restaurant $restaurantModel, Comment $commentModel, AddRestaurant $addRestaurantModel, Menu $menuModel)
	{
		$this->dishModel = $dishModel;
		$this->restaurantModel = $restaurantModel;
		$this->commentModel = $commentModel;
		$this->addRestaurantModel = $addRestaurantModel;
		$this->menuModel = $menuModel;
	}

	public function home()
	{
		$highRateRestaurant = $this->restaurantModel->latest('view')->take(10)->get();
		$lau = $this->restaurantModel->where('dish_id', 1)->get()->random(8);
		$nuong = $this->restaurantModel->where('dish_id', 2)->get()->random(8);
		$menuRandom = $this->menuModel->all()->random(6);

		return [
			'highRateRestaurant' => $highRateRestaurant,
			'lau' => $lau,
			'nuong' => $nuong,
			'menuRandom' => $menuRandom
		];
	}

	public function search($request)
	{
		$address = $restaurant = NULL;

		if (!empty($request->address)) {
			$address = $request->address;
		}
		if (!empty($request->restaurant)) {
			$restaurant = $request->restaurant;
		}
		$restaurantList = $this->restaurantModel->where('name', 'like', '%' . $restaurant . '%')
							   ->orWhere('address', 'like', '%' . $address . '%')
							   ->paginate(20);

		return [
			'restaurantList' => $restaurantList
		];
	}

	public function detail($id)
	{
		$restaurant = $this->restaurantModel->findOrFail($id);
		$restaurant->increment('view');
		$comments = $this->commentModel->where('restaurant_id', $id)->paginate(20);
		$restaurantsBestView = $this->restaurantModel->where('id', '!=', $id)->latest('view')->take(6)->get();

		return [
			'restaurant' => $restaurant,
			'comments' => $comments,
			'restaurantsBestView' => $restaurantsBestView
		];
	}

	public function addRestaurant($inputs)
	{
		$this->addRestaurantModel->create([
			'name' => $inputs['name'],
			'thumb' => $this->uploadThumb($inputs['thumb'], $inputs['name']),
			'type' => $inputs['type'],
			'address' => $inputs['address'],
			'time' => $inputs['time'],
			'price' => $inputs['price'],
			'menu' => $this->uploadMenu($inputs['menu'], $inputs['name'])
		]);
	}

	public function restaurantList($dishId)
	{
		$dish = $this->dishModel->findOrFail($dishId);
		$restaurants = $this->restaurantModel->where('dish_id', $dishId)->latest()->paginate(20);

		return [
			'restaurants' => $restaurants,
			'dish' => $dish
		];
	}

	public function uploadThumb($thumb, $name)
	{
		$fileName = str_slug($name) . '.jpg';
		$thumb->move('upload/add_restaurant', $fileName);

		return $fileName;
	}

	public function uploadMenu($menu, $name)
	{
		
		$string = '';
		foreach ($menu as $menuItem) {
			$fileName = str_slug($name) . '-' . rand() . '.jpg';
			$string = $string . $fileName . '@@@';
			$menuItem->move('upload/add_menu', $fileName);
		}

		return $string;
	}
}