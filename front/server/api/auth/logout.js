export default defineEventHandler((event) => {
  deleteCookie(event, 'accessToken');
})
