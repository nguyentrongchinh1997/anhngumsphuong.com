<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Restaurant;
use App\Model\Menu;
use App\Http\Services\SiteService;
use App\Model\User;
use App\Model\Comment;
use App\Model\Dish;
use View;
use Socialite;

class SiteController extends Controller
{
    protected $siteService;

    public function __construct(SiteService $siteService)
    {
        $this->siteService = $siteService;
        View::share('dishShare', Dish::all());
    }

    public function home()
    {
        return view('pages.home', $this->siteService->home());
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $login = User::updateOrCreate(
                [
                    'email' => $user->email,
                ],
                [
                    'google_id' => $user->id,
                    'name' => $user->name,
                    'image' => $user->avatar, 
                ]
            );

            auth()->login($login);

            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect('login');
        }
    }
    
    public function redirectFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
     public function callbackFacebook()
    {
        $getInfo = Socialite::driver('facebook')->user();
        $user = User::updateOrCreate(
            [
                'email' => $getInfo->email
            ],
            [
                'facebook_id' => $getInfo->id,
                'name' => $getInfo->name,
                'image' => $getInfo->avatar,
            ]
        );
        auth()->login($user, true);
        
        return redirect()->route('home');
    }

    public function search(Request $request)
    {
        return view('pages.search', $this->siteService->search($request));
    }

    public function loginForm()
    {
        return view('pages.login');
    }

    public function signupForm()
    {
        return view('pages.signup');
    }

    public function detail($slug, $id)
    {
        return view('pages.detail', $this->siteService->detail($id));
    }

    public function addRestaurantForm()
    {
        return view('pages.add_restaurant');
    }

    public function restaurantList($name, $id)
    {
        return view('pages.restaurant_list', $this->siteService->restaurantList($id));
    }

    public function addRestaurant(Request $request)
    {
        $this->validate($request, 
            [
                'name' => 'required',
                'thumb' => 'required|file|mimes:jpg,png,jpeg|max:2048',
                'address' => 'required',
                'price' => 'required',
                'type' => 'required',
                'time' => 'required',
            ],
            [
                'name.required' => '* Cần điền tên nhà hàng',
                'thumb.required' => '* Cần tải ảnh nhà hàng',
                'thumb.mimes' => '* Ảnh nhà hàng phải ở định dang jpg,png,jpeg',
                'thumb.max' => '* Dung lượng ảnh nhà hàng không được quá 2Mb',
                'thumb.file' => '* Ảnh nhà hàng sai định dạng',
                'address.required' => '* Cần nhập địa chỉ nhà hàng',
                'price.required' => '* Cần điền khoảng giá tại nhà hàng',
                'type.required' => '* Cần điền hình thức gọi món nhà hàng',
                'time.required' => '* Cần điền thời gian đóng mở cửa',
            ]
        );
        if ($request->menu == NULL) {
            return redirect()->back()->withInput($request->all())->with('error', '* Cần tải thực đơn nhà hàng lên');
        } else {
            foreach($request->menu as $menuItem) {
                $extensiton = $menuItem->getClientOriginalExtension();
                if ($extensiton != 'png' && $extensiton != 'jpg' && $extensiton != 'jpeg') {
                    return redirect()->back()->withInput($request->all())->with('error', '* Cần tải thực đơn nhà hàng lên');
                } else if ($menuItem->getSize()/1024 > 2048) {
                    return redirect()->back()->withInput($request->all())->with('error', '* Ảnh tải lên không được quá 2Mb');
                }
            }
        }
        
        $this->siteService->addRestaurant($request->all());

        return back()->with('success', 'Thêm thành công');
    }

    public function login(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required|email',
                'password' => 'required|max:20|min:5'
            ],
            [
                'email.required' => '* Cần nhập địa chỉ E-mail',
                'email.email' => '* Email sai định dạng',
                'password.required' => '* Cần điền mật khẩu'
            ]
        );
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (auth()->attempt($data, true)) {
            return redirect()->route('home');
        } else {
            return back()->with('error', 'Đăng nhập sai');
        }
    }

    public function logout()
    {
        auth()->logout();

        return back();
    }

    public function signup(Request $request)
    {
        $this->validate($request,
            [
                'full_name' => 'required|max:50|min:5',
                'email' => 'required|unique:users,email|email',
                'password' => 'required|max:20|min:5',
            ],
            [
                'full_name.required' => '* Họ tên là bắt buộc',
                'full_name.max' => '* Họ tên quá dài',
                'full_name.min' => '* Họ tên quá ngắn',
                'email.required' => '* E-mail là bắt buộc',
                'email.email' => '* Sai định dạng E-mail',
                'email.unique' => '* Email này đã tồn tại',
                'password.required' => '* Mật khẩu là bắt buộc',
                'password.max' => '* Mật khẩu tối đa là 20 ký tự',
                'password.min' => '* Mật khẩu tối thiểu là 5 ký tự',
            ]
        );
        $inputs = $request->all();
        $login = route('login-form');
        User::create([
            'name' => strip_tags($inputs['full_name']),
            'email' => $inputs['email'],
            'password' => bcrypt($inputs['password']),
        ]);

        return back()->withInput()->with('success', "Đăng ký thành công, bắt đầu đăng nhập <a href='{{$login}}'>tại đây</a>");
    }

    public function review(Request $request)
    {
        $restaurantId = $request->restaurantId;
        $content = strip_tags($request->content);
        $userId = $request->userId;
        $user = User::findOrFail($userId);

        $comment = Comment::create([
            'user_id' => $userId,
            'restaurant_id' => $restaurantId,
            'content' => $content
        ]);

        return view('pages.review', ['user' => $user, 'comment' => $comment]);
    }

    public function clone()
    {
    	try {
    		$thumb = $address = $name = $type = NULL;
	    	$html = file_get_html('https://pasgo.vn/ha-noi/nha-hang/tiec-cuoi-143');

	    	foreach ($html->find('.wapfoody .wapitem') as $wapitem) {
	    		if (empty($wapitem->find('img', 0)->attr['data-src'])) {
	    			$thumb = $wapitem->find('img', 0)->src;
	    		} else {
	    			$thumb = $wapitem->find('img', 0)->attr['data-src'];
	    		}
	    		$address = $wapitem->find('p.text-address', 0)->plaintext;
	    		$name = $wapitem->find('div.wapfooter a', 0)->plaintext;
	    		$type = trim($wapitem->find('div.waptag', 0)->plaintext);
	    		$link = $wapitem->find('a.waptop', 0)->href;
	    		$this->cloneDetail($link, $thumb, $address, $name, $type);
	    	}	
    	} catch (\Exception $e) {
    		echo $e->getMessage() . '<hr>';
    	}
    }

    public function foodyClone()
    {
        try {
            $link = 'https://www.foody.vn/ho-chi-minh/buffet?ds=Restaurant&vt=row&st=1&c=39&page=';
            for ($i = 3; $i <= 3; $i++) {
                $html = file_get_html_custom($link . $i . '&provinceId=217&categoryId=39&append=true');
                
                foreach ($html->find('.row-item') as $item) {
                    $link = 'https://www.foody.vn' . $item->find('a', 0)->href;
                    $thumbs = $item->find('img', 0)->src;
                    $this->foodyDetail($link, $thumbs);
                }
            }
        } catch (\Throwable $th) {
            echo $e->getMessage() . '<hr>';
        }
    }

    public function foodyDetail($link, $thumbs)
    {
        try {
            $html = file_get_html_custom($link);
            $link_encode = md5($link);
            $check = $this->checkClone($link_encode);
            
            if (!empty($html->find('.main-info-title h1')) && $check == 0) {
                $name = \html_entity_decode($html->find('.main-info-title h1', 0)->plaintext, ENT_QUOTES, 'UTF-8');
                $price = \html_entity_decode($html->find('.res-common-minmaxprice', 0)->plaintext, ENT_QUOTES, 'UTF-8');
                $time = \html_entity_decode($html->find('.micro-timesopen span', 2)->plaintext, ENT_QUOTES, 'UTF-8');
                $address = \html_entity_decode($html->find('.res-common-add', 0)->plaintext, ENT_QUOTES, 'UTF-8');
                $og_image = $html->find("meta[property='og:image']", 0)->content;
                $rate = rand(2,5);
                $type = 'Buffet nướng, hải sản';
                $result = $this->insertRestaurant1(2, $name, $type, $address, $time, $price, $rate, $link, $link_encode, $image_type = 0, $og_image, $thumbs);
                echo "$result<hr>";
            }
        } catch (\Throwable $th) {
            echo $th->getMessage() . ": $link<hr>";
        }
    }

    public function cloneDetail($link, $thumb, $address, $name, $type)
    {
    	try {
    		$link_encode = md5($link);
	    	$check = $this->checkClone($link_encode);

	    	if ($check == 0) {
	    		$html = file_get_html($link);
	    		$price = $html->find('span.pasgo-giatrungbinh', 0)->plaintext;
	    		$time = $html->find('p.hours-pickup', 0)->attr['content'];
	    		$rate = $html->find('span.pasgo-star', 0)->plaintext;
	    		$menu = $this->menu($html->find('#thuc-don .carousel-inner .item img'));
                $og_image = $html->find("meta[property='og:image']", 0)->content;
	    		$result = $this->insertRestaurant(2, $name, $type, $address, $time, $price, $rate, $link, $link_encode);
	    		$og_image = $html->find("meta[property='og:image']", 0)->content;
	    		$result = $this->insertRestaurant(14, $name, $type, $address, $time, $price, $rate, $link, $link_encode);

	    		if (!empty($result)) {
	    			$this->uploadImage($menu, $thumb, $og_image, $name, $result->id);

	    			echo "Thêm thành công<hr>";
	    		}
	    	} else {
	    		echo "Đã thêm<hr>";
	    	}
    	} catch (\Exception $e) {
    		echo $e->getMessage() . "$link<hr>";
    	}
    }

    public function insertRestaurant($dishId, $name, $type, $address, $time, $price, $rate, $link, $link_encode)
    {
    	try {
    		return Restaurant::create([
    			'dish_id' => $dishId,
    			'name' => $name,
    			'slug' => str_slug($name),
    			'thumb' => str_slug($name) . '.jpg',
    			'og_image' => str_slug($name) . '.jpg',
    			'type' => $type,
    			'address' => $address,
    			'time' => $time,
    			'price' => $price,
    			'rate' => $rate,
    			'link' => $link,
                'link_encode' => $link_encode,
    		]);
    	} catch (\Exception $e) {
    		return NULL;
    	}
    }

    public function insertRestaurant1($dishId, $name, $type, $address, $time, $price, $rate, $link, $link_encode, $image_type, $og_image, $thumbs)
    {
    	try {
    		Restaurant::create([
    			'dish_id' => $dishId,
    			'name' => $name,
    			'slug' => str_slug($name),
    			'thumb' => $thumbs,
    			'og_image' => $og_image,
    			'type' => $type,
    			'address' => $address,
    			'time' => $time,
    			'price' => $price,
    			'rate' => $rate,
    			'link' => $link,
                'link_encode' => $link_encode,
                'image_type' => $image_type
    		]);
    		
    		return 'Success';
    	} catch (\Exception $e) {
    		return $e->getMessage();
    	}
    }

    public function uploadImage($menu, $thumb, $og_image, $name, $restaurantId)
    {
	    $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $nameImage = str_slug($name);
        $thumb = file_get_contents($thumb, false, stream_context_create($arrContextOptions));
        file_put_contents(public_path('upload/thumbs/' . $nameImage . '.jpg'), $thumb);

        $og_image = file_get_contents($og_image, false, stream_context_create($arrContextOptions));
        file_put_contents(public_path('upload/og_images/' . $nameImage . '.jpg'), $og_image);

        foreach ($menu as $menuItem) {
        	$imageMenu = $nameImage . '-' . rand() . '.jpg';
        	$menuItemLink = file_get_contents($menuItem, false, stream_context_create($arrContextOptions));
        	file_put_contents(public_path('upload/menus/' . $imageMenu), $menuItemLink);

        	Menu::create([
        		'restaurant_id' => $restaurantId,
        		'name' => $imageMenu
        	]);
        }

    }

    public function menu($img)
    {
    	foreach ($img as $imgItem) {
    		$image[] = $imgItem->src;
    	}
    	
    	return $image;
    }

    public function checkClone($link_encode)
    {
    	$check = Restaurant::where('link_encode', $link_encode)->count();

    	return $check;
    }
}
