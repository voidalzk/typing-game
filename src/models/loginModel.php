require_once __DIR__ . '/../config/mongodb.php';

class LoginModel {
    private $collection;

    public function __construct() {
        global $mongodb;
        $this->collection = $mongodb->selectCollection('typing-game', 'users');
    }

    public function authenticate($username, $password) {
        $user = $this->collection->findOne(['username' => $username]);
        if ($user && password_verify($password, $user['password'])) {
            return true;
        }
        return false;
    }
}
