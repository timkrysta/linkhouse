# Linkhouse Recruitment Task

## Important notes of how I would do it in real life
- Backend
    - Categories would be a separate table with many-to-many relation to articles. (for the purpose of filtering by categories)
    - To schedule the command to refetch the articles we would need to setup a cron job.
- Frontend
    - The frontend part should be done in a server-side framework, because the purpose of articles is ranking good in SEO. Server-side rendered HTML is required so that the crawlers can "see" the content and index it (because most crawlers does not execute javascript).
    - Additionally, instead of filtering the articles on frontend I would implement filter capabilities in the API to not transfer the whole payload unnessesarly.
    - Lastly, I would like to point out that during the frontend part, I was familiarizing myself with Vue.js for the first time. Since I know other JavaScript frameworks such as React or Next.js, I was able to go through the Vue documentation very quickly, but please keep in mind that the result of the frontend part is the result of only less than 2 days of reading the documentation ;)

## Author
Tymoteusz Krysta | krystatymoteusz@gmail.com | +48 694 402 255
