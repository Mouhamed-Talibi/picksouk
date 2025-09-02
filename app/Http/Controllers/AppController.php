<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\FindProductRequest;
    use App\Models\Category;
    use App\Models\Payment;
    use App\Models\Product;
    use App\Models\Testimonial;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\App;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Support\Facades\Session;

    class AppController extends Controller
    {
        // home method
        public function home() {
            $categories = Category::orderBy('name', 'asc')
                ->get();
            $ids = Product::pluck('id')->random(min(8, Product::count()));
            $randomProducts = Product::with([
                    'parfumDetails',
                    'clothesDetails',
                    'electronicsDetails',
                    'health_beauty_Details',
                    'category',
                    'images'
                ])->whereIn('id', $ids)->get();
            $testimonials = Testimonial::where('status', 'accepted')
                ->inRandomOrder()
                ->limit(3)
                ->get();
            return view('home', compact(['categories', 'randomProducts', 'testimonials']));
        }

        // index method
        public function index() {
            $bestSellingProducts = Payment::select('product_id', DB::raw('COUNT(*) as total_sales'))
                ->groupBy('product_id')
                ->orderByDesc('total_sales')
                ->with('product')
                ->take(9)
                ->get();
            $categories = Category::orderBy('name', 'asc')
                ->get();
            // return view with data
            return view('app.index', compact(['bestSellingProducts', 'categories']));
        }

        // contact Us
        public function contactUs() {
            return view('app.contact_us');
        }

        // lang switch method
        public function langSwitch($locale) {
            // check if locale is valid (optional)
            if (! in_array($locale, ['en', 'ar'])) {
                abort(400);
            }

            // Set the locale
            App::setLocale($locale);

            // Store in session
            Session::put('locale', $locale);

            return Redirect::back();
        }

        //  find product method 
        public function findProduct(FindProductRequest $request) {
            $validated = $request->validated();
            $products = Product::where('name', 'like', '%'. $validated['search_text'] . '%')
                ->orWhere('slug', 'like', '%' . $validated['search_text'] . '%')
                ->with(['category', 'images'])
                ->get();
            if($products->isEmpty()) {
                return Redirect::back()->with('warning', '  .لم يتم العثور على منتجات تطابق بحثك. المرجو اعادة المحاولة');
            }
            return view('app.find_product', compact('products'));
        }

        // about us method
        public function aboutUs() {
            return view('app.about');
        }

        // show product
        public function showProduct(Product $product) {
            $product = Product::with([
                'images',
                'parfumDetails',
                'electronicsDetails',
                'health_beauty_Details',
                'clothesDetails',
                'bagsDetails',
            ])->findOrFail($product->id);
            return view('product', compact('product'));
        }

        // products
        public function products() {
            $categories = Category::all();
            $products = Product::with([
                'images',
                'parfumDetails',
                'electronicsDetails',
                'bagsDetails',
                'health_beauty_Details',
                'clothesDetails',
                'category',
            ])->paginate(20);
            return view('products', compact(['products', 'categories']));
        }

    }
