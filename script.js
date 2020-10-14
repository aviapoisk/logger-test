import http from 'k6/http';
import { check, sleep } from 'k6';

export let options = {
  vus: 30,
  //iterations: 1,
  duration: "10s",
  insecureSkipTLSVerify: true,
};

export default function() {
  let res = http.get(`http://127.0.0.1:8071/${__ENV.MY_HOSTNAME}`);
  check(res, {
    "is status 200": r => r.status === 200
  });
}
