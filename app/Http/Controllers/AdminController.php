<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Traits\NotificationTrait;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\{Hash, Crypt};
use App\Http\Requests\Staff\Admin\{
    UserRequest,
    CategoryRequest,
    UserBanRequest,
    AddtodoRequest,
    AdminChatRequest
};
use App\Http\Requests\Staff\NoticeRequest;
use App\Models\{
    User,
    Product,
    Category,
    Conversation,
    Sales,
    Order,
    Todolist,
    ConversationMessage,
    Adminchats,
    Notice,
    HelpRequest,
    Livefeeds,
    Dispute,
    Feedback,
    Report,
    DisputeMessage,
    Market,
    Marketofvendor,
    Reportvendor,
    Slot
};

class AdminController extends Controller
{
    use NotificationTrait;

    public function promoteProduct(Product $product, Request $request)
    {
        // if ($product->featured == 1) {
        //     session()->flash('error', 'This product has already featured!');
        //     return redirect()->back();
        // }

        $product->featured = 1;
        $product->save();

        $slot = new Slot();
        $slot->slotnum = $request->slotnum;
        $slot->product_id = $product->id;
        $slot->save();

        session()->flash(
            'success',
            'You have successfully featured this product in SLOT' .
                $request->slotnum .
                '!'
        );
        return redirect()->back();
    }
    public function unpromoteProduct(Product $product, Request $request)
    {
        $product->featured = 0;
        Slot::where('product_id', $product->id)->delete();
        $product->save();

        session()->flash(
            'success',
            'You have successfully unfeatured this product!'
        );
        return redirect()->back();
    }
    public function delpromoteProduct(Product $product, Request $request)
    {
        $product->deleted = 1;
        $product->save();

        session()->flash(
            'success',
            'You have successfully deleted this product!'
        );
        return redirect()->back();
    }
    /**
     * Dashboard view
     * @return Illuminate\Support\Facades\View
     */
    public function viewDashboard($section)
    {
        return view('staff.admin.dashboard', [
            'section' => $section,
            'totalUsers' => User::count(),
            'totalSellers' => User::where('seller', true)->count(),
            'totalEmployeers' => User::where('moderator', true)
                ->orWhere('admin', true)
                ->count(),
            'countofNewUsers' => User::countofNewUsers(),
            'newUsers' => User::getNewUsers(),
            'totalProducts' => Product::count(),
            'totalMoneros' => \Monerod::getBalance(),
            'orders' => Order::orderBy('created_at', 'DESC')->paginate(5),
            'products' => Product::orderBy('created_at', 'DESC')->paginate(5),
            'users' => User::orderBy('created_at', 'DESC')->paginate(8),
            'todolists' => Todolist::get(),
            'messages' => ConversationMessage::whereNotNull('receiver_id')
                ->orderBy('created_at', 'DESC')
                ->paginate(5),
            'adminchats' => Adminchats::orderBy('created_at', 'ASC')->get(),
        ]);
    }

    public function viewNews($section)
    {
        return view('staff.admin.news', [
            'section' => $section,
        ]);
    }

    public function viewWithdrawalHistory($section)
    {
        return view('staff.admin.withdrawalhistory', [
            'section' => $section,
        ]);
    }

    public function viewWithdrawMarketFees($section)
    {
        return view('staff.admin.withdrawmarketfees', [
            'section' => $section,
        ]);
    }

    public function viewLostMoneyHistory($section)
    {
        return view('staff.admin.lostmoneyhistory', [
            'section' => $section,
        ]);
    }
    public function viewFaqs($section)
    {
        return view('staff.admin.faqs', [
            'section' => $section,
        ]);
    }

    public function postAdminChats(AdminChatRequest $request)
    {
        try {
            return $request->send();
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function addTodo(AddtodoRequest $request)
    {
        try {
            return $request->add();
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function delTodo(Todolist $todo)
    {
        $todolist = Todolist::get()
            ->where('id', $todo->id)
            ->first();
        $todolist->delete();

        return redirect()->back();
    }

    public function viewProducts($section)
    {
        return view('staff.admin.products', [
            'section' => $section,
            'products' => Product::get(),
        ]);
    }

    public function viewOrders($section)
    {
        return view('staff.admin.orders', [
            'section' => $section,
            'orders' => Order::get(),
        ]);
    }

    public function viewVendors($section)
    {
        return view('staff.admin.vendors', [
            'section' => $section,
            'vendors' => User::get()->where('seller', true),
        ]);
    }

    public function viewBannedusers($section)
    {
        return view('staff.admin.bannedusers', [
            'section' => $section,
            'bannedusers' => User::get()->where('ban', true),
        ]);
    }

    // public function viewSupporttickets($section)
    // {
    //     return view('staff.admin.supporttickets', [
    //         'section' => $section,
    //         'tickets' => HelpRequest::paginate(25),
    //     ]);
    // }

    public function viewAdminNotices($section)
    {
        return view('staff.admin.notices', [
            'section' => $section,
            'notices' => Notice::paginate(25),
        ]);
    }

    /**
     * Help requests view
     * @param  Request $request
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewSupport($section, Request $request)
    {
        $status = $request->status;
        #Set helpRequest
        $helpRequests = null;

        if ($status == 'closed') {
            $helpRequests = HelpRequest::where('status', 'closed')->get();
        } elseif ($status == 'opened') {
            $helpRequests = HelpRequest::where('status', 'opened')->get();
        } elseif ($status == 'accepted') {
            $helpRequests = HelpRequest::where('status', 'accepted')->get();
        } else {
            $status = 'all';
            $helpRequests = HelpRequest::get();
        }

        return view('staff.admin.supporttickets', [
            'section' => $section,
            'status' => $status,
            'totalHelpRequests' => HelpRequest::count(),
            'helpRequests' => $helpRequests,
        ]);
    }

    public function viewDisputes($section, Request $request)
    {
        $status = $request->status;
        #Set helpRequest
        $disputes = null;

        if ($status == 'unaccepted') {
            $disputes = Dispute::where('admin_id', null)->get();
        } elseif ($status == 'resolved') {
            $disputes = Dispute::where('status', 'resolved');
        } elseif ($status == 'acceptedbyme') {
            $disputes = Dispute::where('admin_id', auth()->user()->id)->get();
        } elseif ($status == 'acceptedbyothers') {
            $disputes = Dispute::where(
                'admin_id',
                '!=',
                auth()->user()->id
            )->get();
        } elseif ($status = 'all') {
            $disputes = Dispute::get();
        }

        return view('staff.admin.disputes', [
            'section' => $section,
            'status' => $status,
            'disputes' => $disputes,
        ]);
    }

    public function acceptDispute(Dispute $dispute)
    {
        $dispute->admin_id = auth()->user()->id;
        $dispute->save();

        $message = new DisputeMessage();
        $message->dispute_id = $dispute->id;
        $message->user_id = auth()->user()->id;
        $message->message = Crypt::encryptString(
            auth()->user()->username .
                ' has joined the dispute conversation, please explain your worries in detail, so we can help sort it out.'
        );
        $message->save();

        $this->createNotification(
            $dispute->excutor->id,
            'An administrator has accepted your dispute.',
            route('dispute-message', ['order' => $dispute->order->id])
        );

        return redirect()->back();
    }

    public function viewReportvendors($section)
    {
        return view('staff.admin.reportvendors', [
            'section' => $section,
            'reportvendors' => Reportvendor::get(),
        ]);
    }
    public function viewReportproducts($section)
    {
        return view('staff.admin.reportproducts', [
            'section' => $section,
            'reportproducts' => Report::get(),
        ]);
    }
    /**
     * Add notice HTTP request
     * @param  NoticeRequest $request
     *
     * @return App\Http\Requests\Staff\NoticeRequest
     */
    public function postAddNotice(NoticeRequest $request)
    {
        try {
            return $request->add();
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Delete notice HTTP request
     * @param  Notice $notice
     *
     * @return Illuminate\Routing\Redirector
     */
    public function deleteNotice(Notice $notice)
    {
        $notice->delete();

        session()->flash('success', 'Notice successfully deleted!');
        return redirect()->route('admin.notices', ['section' => 'notices']);
    }

    /**
     * Edit configs
     * @param  $namespace
     * @param  $newValue
     * @param  $config
     * @param  $archive
     *
     * @return archive
     */
    private function editConfig($namespace, $newValue, $config, $archive)
    {
        config([$namespace => $newValue]);
        $text = '<?php return ' . var_export(config($config), true) . ';';
        file_put_contents(config_path($archive), $text);
    }

    /**
     * Dashboard HTTP request
     * @param  Request $request
     *
     * @return Illuminate\Routing\Redirector
     */
    public function putDashboard(Request $request)
    {
        $request->validate([
            'seller_fee' => 'required|numeric|min:1',
            'dread_forum_link' => 'required',
            'wiki_link' => 'required',
        ]);

        #Change the fee amount to become a seller
        $this->editConfig(
            'general.seller_fee',
            $request->seller_fee,
            'general',
            'general.php'
        );

        #Edit footer links
        $this->editConfig(
            'general.dread_forum_link',
            $request->dread_forum_link,
            'general',
            'general.php'
        );
        $this->editConfig(
            'general.wiki_link',
            $request->wiki_link,
            'general',
            'general.php'
        );

        session()->flash(
            'success',
            'Market settings have been changed successfully!'
        );
        return redirect()->route('admin.dashboard');
    }

    /**
     * Exit button HTTP request
     *
     * @return Illuminate\Routing\Redirector
     */
    public function postExitButton()
    {
        #Get all users from market
        $users = User::get();

        #Transfer the entire user account balance to your backup wallet
        foreach ($users as $user) {
            if (!is_null($user->backup_monero_wallet)) {
                #Get account TAG from user
                $accountTag = $user->id;

                #Get user balance
                $balance = \Monerod::getBalance($accountTag);

                \Monerod::transfer(
                    $balance,
                    $user->backup_monero_wallet,
                    $accountTag
                );
            }
        }

        $conversations = Conversation::get();

        #Delete all conversations
        foreach ($conversations as $conversation) {
            $conversation->delete();
        }

        session()->flash(
            'success',
            'Sensitive information destroyed and money transferred successfully!'
        );
        return redirect()->route('admin.settings', [
            'section' => 'adminsettings',
        ]);
    }

    /**
     * Search users
     * @param  $username
     * @param  $role
     *
     * @return App\Models\User;
     */
    private function searchUsers($username = null, $role = null)
    {
        #Roles
        $roles = ['seller', 'moderator', 'admin'];

        #Set role filter default value
        $roleFilter = null;

        if ($role == 'seller') {
            $roleFilter = 'seller';
        } elseif ($role == 'moderator') {
            $roleFilter = 'moderator';
        } elseif ($role == 'admin') {
            $roleFilter = 'admin';
        } else {
            $roleFilter = 'all';
        }

        if (in_array($roleFilter, $roles)) {
            $users = User::where('username', 'LIKE', "%$username%")->where(
                $roleFilter,
                true
            );
        } else {
            $users = User::where('username', 'LIKE', "%$username%");
        }

        return $users->orderBy('created_at', 'DESC')->paginate(25);
    }

    /**
     * Users view
     * @param Request $request
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewUsers($section, Request $request)
    {
        $users = $this->searchUsers($request->username, $request->role);

        return view('staff.admin.users', [
            'section' => $section,
            'filters' => $request->all(),
            'username' => $request->username,
            'role' => $request->role,
            'users' => $users,
            'totalUsers' => User::count(),
        ]);
    }

    public function editUser($section, User $user)
    {
        return view('staff.admin.editusers', [
            'markets' => Market::get(),
            'user' => $user,
            'section' => $section,
        ]);
    }

    public function viewLivefeed($section)
    {
        return view('staff.admin.livefeed', [
            'section' => $section,
            'livefeeds' => Livefeeds::orderBy('created_at', 'DESC')->paginate(
                15
            ),
        ]);
    }

    public function viewAdminSettings($section)
    {
        return view('staff.admin.settings', [
            'section' => $section,
            'sellerFee' => config('general.seller_fee'),
            'dreadForumLink' => config('general.dread_forum_link'),
            'wikiLink' => config('general.wiki_link'),
        ]);
    }

    public function viewMessages($section)
    {
        return view('staff.admin.messages', [
            'section' => $section,
            'messages' => ConversationMessage::whereNotNull('receiver_id')
                ->orderBy('created_at', 'DESC')
                ->paginate(100),
        ]);
    }

    public function viewMassMessages($section)
    {
        return view('staff.admin.massmessages', [
            'section' => $section,
        ]);
    }

    /**
     * Send a message to selected groups
     *
     * @param  Request $request
     * @return Illuminate\Routing\Redirector
     */
    public function postMassMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|max:5000',
            'group' => 'required|array',
        ]);

        try {
            if (
                !in_array('buyers', $request->group) and
                !in_array('sellers', $request->group) and
                !in_array('staff', $request->group)
            ) {
                throw new \Exception('User Group is invalid!');
            }

            #Set receivers
            $receivers = new Collection();

            if (in_array('staff', $request->group)) {
                #Get staff
                $staff = User::where('admin', true)
                    ->orWhere('moderator', true)
                    ->get();

                $receivers = $receivers->merge($staff);
            }

            if (in_array('sellers', $request->group)) {
                #Get sellers
                $sellers = User::where('seller', true)->get();

                $receivers = $receivers->merge($sellers);
            }

            if (in_array('buyers', $request->group)) {
                #Get buyers
                $buyers = User::where('seller', false)
                    ->where('moderator', false)
                    ->where('admin', false)
                    ->get();

                $receivers = $receivers->merge($buyers);
            }

            foreach ($receivers as $receiver) {
                $conversation = Conversation::where('issuer_id', null)
                    ->where('receiver_id', $receiver->id)
                    ->first();

                if (is_null($conversation)) {
                    $conversation = new Conversation();
                    $conversation->receiver_id = $receiver->id;
                    $conversation->save();
                }

                $conversationMessage = new ConversationMessage();
                $conversationMessage->conversation_id = $conversation->id;
                $conversationMessage->issuer_id = auth()->user()->id;
                $conversationMessage->message = Crypt::encryptString(
                    $request->message
                );
                $conversationMessage->save();

                $this->createNotification(
                    $receiver->id,
                    'You received a general message from support',
                    route('openconversationmessages')
                );
            }

            session()->flash('success', 'Message sent to users!');
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }

        return redirect()->route('admin.massmessages', [
            'section' => 'massmessages',
        ]);
    }

    public function viewOthermarkets($section)
    {
        return view('staff.admin.othermarkets', [
            'section' => $section,
            'markets' => Market::get(),
        ]);
    }

    public function postASDF(User $user)
    {
        session()->flash('success', 'You have successfully saved this change.');
        return redirect()->route('edituser', [
            'user' => $user->id,
            'section' => 'users',
        ]);
    }

    public function postAddOtherMarkets($section, Request $request)
    {
        $request->validate([
            'marketname' => 'required',
            'marketlogo' => 'required',
        ]);

        $othermarket = new Market();
        $othermarket->name = $request->marketname;
        $othermarket->logo = $request->marketlogo;
        $othermarket->save();

        return redirect()->route('admin.othermarkets', [
            'section' => 'othermarkets',
        ]);
    }

    public function postEditOtherMarkets(
        $section,
        Request $request,
        Market $market
    ) {
        $request->validate([
            'marketname' => 'required',
            'marketlogo' => 'required',
        ]);

        $market->name = $request->marketname;
        $market->logo = $request->marketlogo;
        $market->save();

        return redirect()->route('admin.othermarkets', [
            'section' => 'othermarkets',
        ]);
    }

    public function viewWithdrawals($section)
    {
        return view('staff.admin.withdrawals', [
            'section' => $section,
        ]);
    }

    /**
     * User view
     * @param  User $user
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewUser(User $user)
    {
        return view('staff.admin.user', [
            'user' => $user,
        ]);
    }

    public function unbanUser(User $user)
    {
        $user->ban = 0;
        $user->ban_since = null;
        $user->banreason = null;
        $user->save();

        session()->flash(
            'success',
            'You have successfully unbanned ' . $user->username . '.!'
        );
        return redirect()->back();
    }

    public function banUser(User $user, UserBanRequest $request)
    {
        try {
            return $request->ban($user);
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function viewBanReason(User $user)
    {
        return view('includes.components.banreason', [
            'user' => $user,
        ]);
    }
    /**
     * Edit user HTTP request
     * @param  UserRequest $request
     * @param  User 	   $user
     *
     * @return App\Http\Requests\Staff\Admin\UserRequest
     */
    public function putEditUser(UserRequest $request, User $user)
    {
        try {
            return $request->edit($user);
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Categories view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewCategories($section)
    {
        return view('staff.admin.categories', [
            'section' => $section,
            'allCategories' => Category::get(),
            'rootsCategories' => Category::roots(),
        ]);
    }

    /**
     * Add category request
     * @param  CategoryRequest $request
     *
     * @return App\Http\Requests\Staff\Admin\CategoryRequest
     */
    public function postAddCategory(CategoryRequest $request)
    {
        try {
            return $request->add();
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Edit category view
     * @param  Category $category
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewCategory($section, Category $category)
    {
        return view('staff.admin.category', [
            'allCategories' => Category::get(),
            'category' => $category,
            'section' => $section,
        ]);
    }

    /**
     * Edit user HTTP request
     * @param  CategoryRequest $request
     * @param  Category 	   $category
     *
     * @return App\Http\Requests\Staff\Admin\CategoryRequest
     */
    public function putEditCategory(
        CategoryRequest $request,
        Category $category
    ) {
        try {
            return $request->edit($category);
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Delete category HTTP request
     * @param  Category $category
     *
     * @return Illuminate\Routing\Redirector
     */
    public function deleteCategory(Category $category)
    {
        try {
            if ($category->totalProducts() > 0) {
                throw new \Exception(
                    'This category has products, you cannot delete it!'
                );
            }

            $category->delete();

            session()->flash('success', 'Category successfully deleted!');
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }

        return redirect()->route('admin.categories', [
            'section' => 'categories',
        ]);
    }

    public function editMainSettings(User $user, Request $request)
    {
        $request->validate([
            'username' => 'required',
            // 'avatar' =>
            //     'required|image|mimes:jpeg,jpg,png|dimensions:min_width=96,min_height=96|max:300',
        ]);

        $user->username = $request->username;
        if ($request->description != null) {
            if ($user->seller == '1') {
                $user->seller_description = $request->profile;
            } else {
                $user->description = $request->profile;
            }
        }
        if ($request->avatar != null) {
            $avatar = $request->avatar->store('img'); #Save avatar image
            // $path = $_SERVER['DOCUMENT_ROOT']."/storage/$avatar"; #Take the avatar's path
            $path = base_path("/storage/app/$avatar"); #Take the product image path
            $type = pathinfo($path, PATHINFO_EXTENSION); #Get avatar image type
            $image = file_get_contents($path); #Get the avatar image
            $avatarBase64 = "data:image/$type;base64," . base64_encode($image); #Convert avatar image to base64
            Storage::delete($avatar); #Delete the avatar image from the server as it is no longer needed
            $user->avatar = $avatarBase64;
        }
        if ($request->status == 'admin') {
            $user->moderator = '0';
            $user->seller = '0';
            $user->admin = '1';
        }
        if ($request->status == 'mod') {
            $user->moderator = '1';
            $user->seller = '0';
            $user->admin = '0';
        }
        if ($request->status == 'seller') {
            $user->moderator = '0';
            $user->seller = '1';
            $user->seller_since = Carbon::now();
            if (\Monerod::createNewAddress() == null) {
                session()->flash(
                    'error',
                    'WE ARE HAVING TECHNICAL DIFFICULTIES, PLEASE TRY AGAIN LATER.'
                );

                return redirect()->back();
            } else {
                $user->bid_monero_wallet = \Monerod::createNewAddress();
            }
            $user->admin = '0';
        }
        if ($request->status == 'buyer') {
            $user->moderator = '0';
            $user->seller = '0';
            $user->admin = '0';
        }
        //FE Rights
        if ($request->fe == 'on') {
            $user->fe = 1;
        } else {
            $user->fe = 0;
        }

        $user->save();
        session()->flash('success', 'You have successfully changed.');
        return redirect()->back();
    }

    public function editBanUser(User $user, Request $request)
    {
        $request->validate([
            'banreason' => 'required',
        ]);

        if ($request->ban == 'ban') {
            $user->ban = '1';
        } else {
            $request->ban = '0';
        }
        $user->banreason = $request->banreason;
        $user->save();
        session()->flash(
            'success',
            'You have successfully banned ' . $user->username . '.'
        );
        return redirect()->back();
    }

    public function editPGP(User $user, Request $request)
    {
        if ($request->two_factor = '2fa') {
            $user->two_factor = '1';
        } else {
            $user->two_factor = '0';
        }
        $user->pgp_key = $request->pgpkey;

        $user->save();
        session()->flash('success', 'You have successfully changed.');
        return redirect()->back();
    }

    public function editFakeFeedback(User $user, Request $request)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'product_name' => 'required',
            'review' => 'required',
        ]);

        $buyer = User::inRandomOrder()->first();

        $feedback = new Feedback();
        $feedback->product_id = $request->product_name;
        $feedback->buyer_id = $buyer->id;
        $feedback->seller_id = $user->id;
        if ($request->positive == 'positive') {
            $feedback->type = 'positive';
        } elseif ($request->neutral == 'neutral') {
            $feedback->type = 'neutral';
        } else {
            $feedback->type = 'negative';
        }
        $feedback->message = $request->review;
        $feedback->rating = $request->rating;
        $feedback->save();

        session()->flash('success', 'You have successfully sent Fake Feedback');
        return redirect()->back();
    }
}