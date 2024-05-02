"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _vueRouter = require("vue-router");

var _sweetalert = _interopRequireDefault(require("sweetalert2"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _getRequireWildcardCache() { if (typeof WeakMap !== "function") return null; var cache = new WeakMap(); _getRequireWildcardCache = function _getRequireWildcardCache() { return cache; }; return cache; }

function _interopRequireWildcard(obj) { if (obj && obj.__esModule) { return obj; } if (obj === null || _typeof(obj) !== "object" && typeof obj !== "function") { return { "default": obj }; } var cache = _getRequireWildcardCache(); if (cache && cache.has(obj)) { return cache.get(obj); } var newObj = {}; var hasPropertyDescriptor = Object.defineProperty && Object.getOwnPropertyDescriptor; for (var key in obj) { if (Object.prototype.hasOwnProperty.call(obj, key)) { var desc = hasPropertyDescriptor ? Object.getOwnPropertyDescriptor(obj, key) : null; if (desc && (desc.get || desc.set)) { Object.defineProperty(newObj, key, desc); } else { newObj[key] = obj[key]; } } } newObj["default"] = obj; if (cache) { cache.set(obj, newObj); } return newObj; }

var AuthenticatedLayout = function AuthenticatedLayout() {
  return Promise.resolve().then(function () {
    return _interopRequireWildcard(require('@/layouts/AuthenticatedLayout.vue'));
  });
};

var DashBoardLayout = function DashBoardLayout() {
  return Promise.resolve().then(function () {
    return _interopRequireWildcard(require('@/layouts/DashBoardLayout.vue'));
  });
};

var checkUserType = function checkUserType(to, from, next) {
  var user = JSON.parse(localStorage.getItem('user'));

  if (user.role == 'admin') {
    console.log('ok');
    next();
  } else {
    _sweetalert["default"].fire({
      icon: "error",
      title: "Oops...",
      text: "You are not authorized to access this page!"
    });

    next('/');
  }
};

var routes = [{
  path: '/',
  component: AuthenticatedLayout,
  children: [{
    path: '',
    name: 'Home',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('@/pages/Home.vue'));
      });
    }
  }, {
    path: '/all-cources',
    name: 'AllCources',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('@/pages/AllCources.vue'));
      });
    }
  }, {
    path: 'login',
    name: 'Login',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('@/pages/Login.vue'));
      });
    }
  }, {
    path: 'register',
    name: 'Register',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('@/pages/Register.vue'));
      });
    }
  }, {
    path: '/create-course',
    name: 'CreateCourse',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('@/pages/CreateCourse.vue'));
      });
    }
  }, {
    path: '/update-course/:id',
    name: 'UpdateCourse',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('@/pages/UpdateCourse.vue'));
      });
    },
    beforeEnter: checkUserType
  }]
}, {
  path: '/dashboard',
  component: DashBoardLayout,
  children: [{
    path: '',
    name: 'DashBoard',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('@/pages/DashBoard.vue'));
      });
    }
  }, {
    path: 'profile',
    name: 'Profile',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('@/pages/Profile.vue'));
      });
    }
  }, {
    path: "edit-profile",
    name: "EditProfile",
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('@/pages/EditProfile.vue'));
      });
    }
  } // {
  //   path: 'settings',
  //   name: 'Settings',
  //   component: () => import('@/pages/Settings.vue')
  // },
  ]
}];
var router = (0, _vueRouter.createRouter)({
  history: (0, _vueRouter.createWebHistory)(),
  routes: routes
});
router.beforeEach(function (to, from, next) {
  var isAuthenticated = localStorage.getItem('token');

  if (!isAuthenticated && to.path !== '/login' && to.path !== '/register') {
    next('/login');
  } else {
    next();
  }
});
var _default = router;
exports["default"] = _default;